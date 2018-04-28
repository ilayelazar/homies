
  /*************************Recipe Search *************************/

  function wordValidator(string){
    
    if (typeof string !== 'undefined' && string!=='' && string!==null){
        var reg= /^[a-z][a-z\s]*$/;
        var test= reg.test(string);
        if (test){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}

function renderData(data){

		console.log("info data:");
  		console.log(data);
        var obj= JSON.parse(data);
        var hits=obj["hits"];
        var hits_amount=obj["to"];
        var default_url="./img/default.jpg";

        $( ".result_container" ).empty(); // remove all prev search

        if (hits_amount>0){
          $(".has_results").addClass("result_container");
              for (i = 0; i <hits_amount; i++) { 
                    var recipe_info=hits[i]["recipe"];
                    var name= recipe_info["label"];
                    var calories= recipe_info["calories"];
                    calories=Math.round(calories * 100) / 100;
                    var tags= recipe_info["healthLabels"].toString();  // dietLabels 
                    var recipe_url=recipe_info["shareAs"];
                    var img_url=recipe_info["image"];
                    var ingredients_arr=JSON.stringify(recipe_info["ingredients"]);  //ingredientLines
                    // generate row html 
                    var temp_row=createRecipeRow(name,calories,tags,ingredients_arr,i);
                    $( ".result_container" ).append(temp_row );
                    $("#img_"+i )
                        .on( "error",function() { $( this ).attr( "src", default_url );})
                        .attr( "src", img_url );

               } // end for loop 

          var all_rows=$(".recipe-row");
          all_rows.css('padding-top','2%');
          all_rows.css('background-image','url("./img/background-recipes.jpg")');
          all_rows.css('border-bottom','1px solid purple');
        } // end if

        else{
          $(".has_results").removeClass("result_container");
        }

      $(".glyphicon-plus").on( 'click', function(){
      console.log('click event');
      var json=$(this).parent().parent().parent().find('[id^=json_data_]')[0]['innerText'];
      var user_name="1";
      saveRecipeIngredient(json,user_name);
      //need to check if sent all data correctly

      var ok_msg='<div class="alert alert-success alert-dismissable my_alert">';
      ok_msg+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      ok_msg+='Success! Ingrediants Added Successfuly to grocery list!';
      ok_msg+='</div>';
      $(this).removeClass('glyphicon-plus');
      $(this).addClass('glyphicon-ok');
      
      $('.customized_alert').html(ok_msg);
     $('.customized_alert').css("display","block");
     $(this).unbind( "click" );
     });
   return true;
};

  function appendImage(image_url){

  var default_url="./img/default.jpg";

  var image_src="";

  }

    function searchRecipe(searchQuery){
        console.log(searchQuery);

      if (wordValidator(searchQuery)){
        var searchQueryLowCase= searchQuery.toLowerCase();
        searchQueryLowCase = searchQueryLowCase.replace(/ +(?= )/g,'');
        searchQueryLowCase = searchQueryLowCase.split(' ').join('+');
        getLiveData(searchQueryLowCase);
      }
      else{
      var alert_msg='<div class="alert alert-warning alert-dismissable">';
      alert_msg+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      alert_msg+='Alert! You can enter english characters only';
      alert_msg+='</div>';
      $('.customized_alert').html(alert_msg);
     $('.customized_alert').css("display","block");
      }    
  }



  function createRecipeRow(name,calories,tags,ingredients_arr,id){

    /* get data of row and create new html row*/



    var row_html='<div class="row recipe-row">';



    /* plus col*/

    var col_1='<div class=" col-md-1"><br><div class="circle-green">';

    col_1= col_1+' <span class="glyphicon-plus-custom1 glyphicon glyphicon-plus"> </span>';

    col_1= col_1+'</div></div>';



    /* picture col*/ 

    var col_2='<div class="col-md-4">';

    col_2=col_2+'<img id="img_'+id+'" src="" class="img-responsive img-rounded" alt="" style="width:75%;height:auto;">';

    col_2=col_2+'</div>';



      /* info col*/

     var col_3='<div class=" col-md-6">';

     col_3=col_3+'<span> Name: </span><span> '+name+' </span><br><br>';

     col_3=col_3+'<span> Calories: </span> <span> '+calories+' </span><br><br>';

     col_3=col_3+'<span> Tags: </span><span> '+tags+' </span> <br>';

     col_3=col_3+'</div>';


     var col_4='<div id="json_'+id+'" class="hidden">';

     col_4=col_4+'<span id="json_data_'+id+'" class="hidden"> '+ingredients_arr+' </span>';

     col_4=col_4+'</div>';



                    

     row_html=row_html+col_1+col_2+col_3+col_4+'</div>' ;                           

     

     return row_html;                                           

  };


  /****************************************************************/



  function isFirstTab(){

    var first_tab=$("#myTabs").find("a").attr("aria-expanded");
    if (first_tab){ return 1;}
    else { return 0; }

    }
    function deleteMe(name) {
    var row= $("."+name).parent();
    row.remove();
   var first_td_class=$("#grocery_list").find('td')[0]['className'];
   if (first_td_class=='dataTables_empty'){
     $('.dataTables_empty').css('display','');
   }}

     function createGroceryListRow(rowData){

      $('.dataTables_empty').css('display','none');
      var rows = document.getElementById('grocery_list').rows.length;
      countNew ++;
      var rowTB1 =

              "<tr data-type='new' class='row"+rows+"'>" +
                  '<td class="sorting_'+countNew+'"> <input id="sorting_'+countNew+'" type="text" name="item" value="'+rowData['ingrediantname']+'"> </td>'+
                  '<td class="amount_'+countNew+'"> <input id="amount_'+countNew+'" type="number" name="amount" value="'+rowData['amount']+'" min="1"> </td>'+
                  '<td class="unit_'+countNew+'"> <input id="unit_'+countNew+'" type="text" name="amount" value="'+rowData['unit']+'"></td>'+
                  '<td id="delete" class="delete_'+countNew+'" onClick="deleteMe(\'delete_'+countNew+' \')">  <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button> </td>'+
              '</tr>';
      $('#grocery_list').prepend(rowTB1);
  }

    function renderDataFromDb(){
      var groupId='1';
      var groceryList= loadGroceryListFromDb(groupId);
    }

   function validateAllRows(){
      var input_array= $("#grocery_list_wrapper tbody input");

      var valid=true;

      for(var j=0;j<input_array.length;j++ ){

        var id = input_array[j]["id"];
        var value=input_array[j]["value"];

        if (typeof value == 'undefined' || value=="" || value==null){
          valid=false;
           console.log(input_array[j]["id"]+"is empty");
          
          $("#"+id).css("border", "2px solid red");
        }else{
          $("#"+id).css("border", "");
        }
      }
      if (!valid){ alert("please fill all the data");}
       return valid;
    }

   function saveAllRows(){

     var flag=validateAllRows();
     if(flag){

               var input_array= $("#grocery_list_wrapper tbody input");
               var allTableInfo={};
              for(var j=0;j<input_array.length;j+=3 ){

                   var row=j/3;
                   allTableInfo[row]={'ingrediantname' : input_array[j]["value"], 
                                     'amount':input_array[j+1]["value"],
                                     'unit':input_array[j+2]["value"]
                                      };
              }
            var data_to_save_encoded=JSON.stringify(allTableInfo);

          
            var groupId="1"; 
            saveGroceryListToDb(data_to_save_encoded,groupId);
    }
    else{
      return false;
      }
  }




var countNew = 0;

$(document).ready(function() {


  /*************************Recipe Search *************************/

  var has_results=0;

  $(".search-btn").on( 'click', function(){

     var search_string=$('#Search').val();

     searchRecipe(search_string);
     
  });

  /****************************************************************/

   $('#grocery_list').DataTable(
    {

    "order": [],
        "fnDrawCallback": function( oSettings ) { renderDataFromDb();},
        
    "columnDefs": [{
      "targets": 'no-sort',
      "orderable": false,
      
    }]
  });
   

   //debugger;

   initPages('grocery_list',10);
   $('#addRow').on('click', function (e) {

        //t.row.add( [ ] ).draw( false );
        //prevent more clicking

        e.preventDefault();

        // hide no data div
         var emptyrow=[];
         emptyrow['ingrediantname']="";
         emptyrow['amount']="";
         emptyrow['unit']="";
         createGroceryListRow(emptyrow);
            pages = pager1.getPages();
            refreshPapers(1);
     } );


   $('#saveAllRows').on('click', function (e) {
      saveAllRows();
   });


} );
