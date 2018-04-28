


function saveAllOpenBills(bills_json){
    var url='http://ilayel.mtacloud.co.il/homies/dev/billsController.php';

    $.post(url,
    {
        "jsonData": bills_json,
        "requestType": "saveAllOpenBills"
    },
    function(data, status){

        console.log("bills was saved good");
         console.log(data);

    });
}