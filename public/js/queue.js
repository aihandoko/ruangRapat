$(function () {
  let queueData;
  let queueDenyData;

	$("#queueList").DataTable({
    data: queueData,
    columnDefs: [{
      "searchable": false,
      "orderable": false,
      "targets": 0
    }],
        order: [[ 1, 'asc' ]],
        createdRow: function (row, data, dataIndex) {
        	$(row).find("td:eq(0)").attr("data-label", "No");
        	$(row).find("td:eq(1)").attr("data-label", "Site");
        	$(row).find("td:eq(2)").attr("data-label", "SPMB");
        	$(row).find("td:eq(3)").attr("data-label", "Unit Peminta");
        	$(row).find("td:eq(4)").attr("data-label", "Detail");
        },
    });

    $("#queueDenyList").DataTable({
    	data: queueDenyData,
    	columns: [
    		{title: "No", width: 25},
            { title: "Site" },
            { title: "SPMB" },
            { title: "Unit Peminta" },
            { title: "Detail" },
        ],
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order: [[ 1, 'asc' ]],
        createdRow: function (row, data, dataIndex) {
        	$(row).find("td:eq(0)").attr("data-label", "No");
        	$(row).find("td:eq(1)").attr("data-label", "Site");
        	$(row).find("td:eq(2)").attr("data-label", "SPMB");
        	$(row).find("td:eq(3)").attr("data-label", "Unit Peminta");
        	$(row).find("td:eq(4)").attr("data-label", "Detail");
        },
  });

  if(window.location.href == `${HOST}/` || window.location.href == `${HOST}/queue` || window.location.href == `${HOST}/queue/`) {
  	setTimeout(() => {
    $.ajax({
      type: "POST",
      url: `${HOST}/queue/apiGetProcess`,
      beforeSend: function () {
      	$('#queueList .dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
      },
      success: function (response) {
        $('#queueList').DataTable().clear();
        $('#queueList').DataTable().rows.add(response);
        $('#queueList').DataTable().draw();
      },
      error: function () {
      	$('#queueList .dataTables_empty').html('Data gagal di retrieve.')
      },
      complete: function () {}
    })    
    $.ajax({
      type: "POST",
      url: `${HOST}/queue/apiGetDeny`,
      beforeSend: function () {
      	$('#queueDenyList .dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
      },
      success: function (response) {
        $('#queueDenyList').DataTable().clear();
        $('#queueDenyList').DataTable().rows.add(response);
        $('#queueDenyList').DataTable().draw();
      },
      error: function () {
      	$('#queueDenyList .dataTables_empty').html('Data gagal di retrieve.')
      },
      complete: function () {}
    })
}, 50)
  }
  $('#queueList').DataTable().on( 'order.dt search.dt', function () {
        let i = 1;
 
        $('#queueList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
            this.data(i++);
        } );
    } ).draw();
  $('#queueDenyList').DataTable().on( 'order.dt search.dt', function () {
        let i = 1;
 
        $('#queueDenyList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
            this.data(i++);
        } );
    } ).draw();
});