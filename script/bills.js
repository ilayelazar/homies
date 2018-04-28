
      
   //dealing with option: other
   
   function showfield(id, name) {
   
       if (name == 'Other') {
   
           $('#' + id).css('display', 'block');
   
       } else {
   
           $('#' + id).css('display', 'none');
   
       }
   
   }
   
   //delete row
   
   function deleteMe(name) {
   
       var row = $("." + name).parent();
   
       row.remove();
   
       var first_td_class = $("#pay_bills").find('td')[0]['className'];
   
       if (first_td_class == 'dataTables_empty') {
   
           $('.dataTables_empty').css('display', '');
   
       }
   
   }




   $(document).ready(function() {
   
       //initalize 2 data tables
       $('#pay_bills').DataTable({
           "order": [],
           "columnDefs": [{
               "targets": 'no-sort',
               "orderable": false,
           }]
       });
  
       //add search function+ add second data table
       $('#pay_report tfoot th').each(function() {
           var title = $(this).text();
           $(this).html('<input type="text" placeholder="Search ' + title + '" />');
       });
   
   
   
       // DataTable
       var table = $('#pay_report').DataTable({}
       );
   
   
       // Apply the search
       table.columns().every(function() {
           var that = this;
           $('input', this.footer()).on('keyup change', function() {
               if (that.search() !== this.value) {
                   that
                       .search(this.value)
                       .draw();
               }
           });
       });

       function dateInShortDate(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!

            var yyyy = today.getFullYear();
            if(dd<10){
                dd='0'+dd;
            } 
            if(mm<10){
                mm='0'+mm;
            } 
            var today = yyyy+'-'+mm+'-'+dd;
            return today;
       }
   
      function validateAllBillsRows(){
      var input_array= $("#pay_bills tbody input");
      var select_array= $("#pay_bills tbody select");

      var valid=true;

      for(var j=0;j<input_array.length;j+=5 ){

        var id=[];
        var row= parseInt(j/5);

         id[1] = input_array[j]["id"];
         id[2] = select_array[row]["id"];
         id[3] = input_array[j+1]["id"];
         id[4] = input_array[j+2]["id"];
         id[5] = input_array[j+3]["id"];
         id[6] = input_array[j+4]["id"];

        var value=[];

         value[1]=input_array[j]["value"];
         value[2]=select_array[0]["value"];
         value[3]=input_array[j+1]["value"];
         value[4]=input_array[j+2]["value"];
         value[5]=input_array[j+3]["value"];
         value[6]=input_array[j+4]["value"];


        var input_curropted=false;

       for(var index=1;index<7;index++ ){
        if (typeof value[index] == 'undefined' ||  value[index]==null){

           $("#"+id[index]).css("border", "2px solid red");
          input_curropted=true;
        }
      }
      
      if (!input_curropted) {
        if (value[1]==""){
          $("#"+id[1]).css("border", "2px solid red");
          input_curropted=true;
        }
        if (value[4]==""){
          $("#"+id[4]).css("border", "2px solid red");
          input_curropted=true;
        }
        if (value[5]=="") {
          $("#"+id[5]).css("border", "2px solid red");
          input_curropted=true;
        }

        if ( value[2]=="Other" && value[3]==""){
          $("#"+id[3]).css("border", "2px solid red");
          input_curropted=true;
        }
           
      }
      
      }

      if (input_curropted){ alert("please fill all the data");}
      else{ $("#pay_bills tbody input").css("border", "");}

      return !input_curropted;
      }
      
    

     function saveAllBills(){

      var flag=validateAllBillsRows();
      if (flag){

      var input_array= $("#pay_bills tbody input");
      var select_array= $("#pay_bills tbody select");
      var allBillsRows= {};
      var group_id=1;

      for(var j=0;j<input_array.length;j+=5 ){

           var row= parseInt(j/5);
           var type=select_array[row]["value"];

           if (type=="Other"){
            type=input_array[j+1]["value"];
           }
           input_array[j+1]; 

           allBillsRows[row]={

                             'date_added':input_array[j]["value"],
                             'type' : type, 
                             'amount':input_array[j+2]["value"],
                             'due_date':input_array[j+3]["value"],
                             'comments':input_array[j+4]["value"],
                             'group_id':group_id,
                              };
      }

      allBillsRowsJson=JSON.stringify(allBillsRows);
      //console.log(allBillsRowsJson);
      saveAllOpenBills(allBillsRowsJson);

     }else{
        console.log("bills is corrupted");
       }
   }
   
   

       $('#saveAllBills').on('click', function(e) {

        saveAllBills();
       });
       //add new row
   
       var countNew = 0;
       initPages('pay_bills', 10);
       $('#addRow').on('click', function(e) {
   
           //t.row.add( [ ] ).draw( false );
           //prevent more clicking
           e.preventDefault();
           // hide no data div
           $('.dataTables_empty').css('display', 'none');
           var rows = document.getElementById('pay_bills').rows.length;
           countNew++;
           var currentDate=dateInShortDate();
           var rowTB1 =
  
               "<tr data-type='new' class='row" + rows + "'>" +
   
               '<td class="sorting_' + countNew + '"> <input id="sorting_' + countNew + '" type="date" name="date"> </td>' +
   
               '<td class="types' + countNew + '">' +
   
               ' <select name="type_payments" id="types_' + countNew +
   
               '" onchange="showfield(\'other_' + countNew + ' \',this.options[this.selectedIndex].value)">&gt;' +
   
               '<option value="Gas">Gas</option>' +
   
               '<option value="Electricity">Electricity</option>' +
   
               '<option value="Water Charges">Water Charges</option>' +
   
               '<option value="Municipal Taxes">Municipal Taxes</option>' +
   
               '<option value="Other">Other</option>' +
   
               '</select>' +
   
               '<div id="other_' + countNew + '" class"other_title" style="display: none;">' +
   
               '<input id="other_' + countNew + '"   type="text" name="additional_option">' +
   
               '</div>' +
   
               '</td>' +
   
               '<td class="sum_' + countNew + '"> <input type="number" id="sum_' + countNew + '" name="sum" step="10" min="0"> </td>' +
   
               '<td class="sorting_' + countNew + '"> <input id="sorting2_' + countNew + '" type="date" name="date"> </td>' +
   
               '<td class="comments_' + countNew + '"> <input id="comments_' + countNew + '" type="text" rows="1" cols="20" name="comments"></input> </td>' +
   
               '<td id="delete" class="delete_' + countNew + '" onClick="deleteMe(\'delete_' + countNew + ' \')"> <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button> </td>' +
               '<td id="pay" class="pay_' + countNew + '" onClick="deleteMe(\'pay' + countNew + ' \')"> <button type="button" class="btn"><i class=" glyphicon glyphicon-euro"></i></button> </td>'
   
               '</tr>';
   
   
   
           $('#pay_bills').prepend(rowTB1);
           pages = pager1.getPages();
           refreshPapers(1);
           $("#sorting_"+countNew).val(currentDate);
           $("#sorting2_"+countNew).val(currentDate);
           $("#sum_"+countNew).val(0);
       });
   
   });
   
   //export to excel
       $("#export").click(function() {
       $("#pay_report").table2excel({
       });
   
   });
   
