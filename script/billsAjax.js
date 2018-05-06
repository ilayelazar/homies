


function saveAllOpenBills(new_bills_json){
    var url='http://ilayel.mtacloud.co.il/homies/dev/billsController.php';
    $.post(url,
    {
        "jsonDataNew": new_bills_json,
     //   "jsonDataDb": db_bills_json,
        "requestType": "saveAllOpenBills"
    },
    function(data, status){

        console.log(data);
        console.log("bills was saved good");

    });
}


function loadBillsFromDbAjax(){
    var url='billsController.php';
    $.post(url,
    {
        "requestType": "loadBills"
    },
    function(data, status){

        console.log(data);

        var data =JSON.parse(data);

        var rowsAmountFromDb= renderBills(data);

        return  rowsAmountFromDb;  // return the number of rows
    });
}


function payBillAjax(row_id,row_type,data){
    var url='billsController.php';
    $.post(url,
    {
        "jsonData": data,
        "rowType": row_type,
        "rowId": row_id,
        "requestType": "payBill"
    },
    function(data, status){

      
        var row= $("#"+row_type+row_id).parent().parent();
        $(row[0]["children"][5]).click();

        alert("bills was payed");
        console.log(data);
        window.location = window.location.href;

    });
}







