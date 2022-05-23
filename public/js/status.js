$(function () {

	// STATUS DUMMY
  $('.filter-icon').tooltip({
    title: function() {
      return ($(this).hasClass('hide')) ? 'Show filter' : 'Hide filter'
    },
    placement: 'left'
  });
  $('.filter-icon').on('click', function() {
    $(this).tooltip("hide");
    $(this).toggleClass('hide');
    $('.status-box').toggleClass('hide')
    $('.page-title-wrapper').toggleClass('no-border')
  })

  let dummyData = [];

  const dummyStatusList = $("#dummyStatusList").DataTable({
        data: dummyData,
        columns: [
            {
              title: "No",
            },
            { title: "SPMB" },
            { title: "Site" },
            { title: "Step1" },
            { title: "Step2" },
            { title: "Step3" },
            { title: "Step4" },
            { title: "Step5" },
            { title: "Step6" },
            { title: "Step7" },
        ],
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order: [[ 1, 'asc' ]],
    createdRow: function (row, data, dataIndex) {
      $(row).find("td:eq(0)").attr("data-label", "No");
      $(row).find("td:eq(1)").attr("data-label", "SPMB");
      $(row).find("td:eq(2)").attr("data-label", "Site");
      $(row).find("td:eq(3)").attr("data-label", "Step1");
      $(row).find("td:eq(4)").attr("data-label", "Step2");
      $(row).find("td:eq(5)").attr("data-label", "Step3");
      $(row).find("td:eq(6)").attr("data-label", "Step4");
      $(row).find("td:eq(7)").attr("data-label", "Step5");
      $(row).find("td:eq(8)").attr("data-label", "Step6");
      $(row).find("td:eq(9)").attr("data-label", "Step7");
    },
  });

  if(window.location.href == `${HOST}/status/tes`) {
  	setTimeout(() => {
    $.ajax({
      type: "POST",
      url: `${HOST}/apis/status/getAll`,
      dataType: 'JSON',
      data: {},
      beforeSend: function () {
      	$('#dummyStatusList .dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
    },
      success: function (response) {
        dummyStatusList.clear();
        dummyStatusList.rows.add(response);
        dummyStatusList.draw();
      },
      error: function () {},
      complete: function () {}
    })
}, 50)
  }
  $('#dummyStatusList').DataTable().on( 'order.dt search.dt', function () {
        let i = 1;
 
        $('#dummyStatusList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
            this.data(i++);
        } );
    } ).draw();

  $('form[name="dummyShowForm"]').on('submit', function(e) {
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#subtitle").offset().top
    }, 500);
    const unit = 2
    const no = 1;
    const deptId = 43
    $.ajax({
      type: "POST",
      url: `${HOST}/apis/status/params`,
      dataType: 'JSON',
      data: {unit, no, deptId},
      beforeSend: function () {
        $('#dummyStatusList').DataTable().clear();
        $('#dummyStatusList').DataTable().draw();
        $('.dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
        // setTimeout(() => {
          $('.status-box input, .status-box .stat-param button').attr('disabled', true)
        // }, 3000)
      },
      success: function (response) {
        $('#dummyStatusList').DataTable().clear();
        $('#dummyStatusList').DataTable().rows.add(response);
        $('#dummyStatusList').DataTable().draw();
      },
      error: function () {},
      complete: function () {
        $('.status-box input, .status-box .stat-param button').attr('disabled', false)
      }
    })
  })

  $('form[name="dummyShowForm"] .clear').on('click', function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#subtitle").offset().top
    }, 500);
  	$('form[name="dummyShowForm"]')[0].reset();
    $.ajax({
      type: "POST",
      url: `${HOST}/apis/status/getAll`,
      beforeSend: function () {
        $('#dummyStatusList').DataTable().clear();
        $('#dummyStatusList').DataTable().draw();
        $('.dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
        $('.status-box input, .status-box .stat-param button').attr('disabled', true)
      },
      success: function (response) {
        $('#dummyStatusList').DataTable().clear();
        $('#dummyStatusList').DataTable().rows.add(response);
        $('#dummyStatusList').DataTable().draw();
      },
      error: function () {},
      complete: function () {
      	$('.status-box input, .status-box .stat-param button').attr('disabled', false)
      }
    })
  })

  // END Dummy

  let statusData;

  $("#statusList").DataTable({
  	data: statusData,
  	columnDefs: [ {
  		"searchable": false,
  		"orderable": false,
  		"targets": 0
  	}],
  	order: [[ 1, 'asc' ]],
    createdRow: function (row, data, dataIndex) {
      $(row).find("td:eq(0)").attr("data-label", "No");
      $(row).find("td:eq(1)").attr("data-label", "SPMB");
      $(row).find("td:eq(2)").attr("data-label", "Site");
      $(row).find("td:eq(3)").attr("data-label", "Step1");
      $(row).find("td:eq(4)").attr("data-label", "Step2");
      $(row).find("td:eq(5)").attr("data-label", "Step3");
      $(row).find("td:eq(6)").attr("data-label", "Step4");
      $(row).find("td:eq(7)").attr("data-label", "Step5");
      $(row).find("td:eq(8)").attr("data-label", "Step6");
      $(row).find("td:eq(9)").attr("data-label", "Step7");
    },
  });

  if(window.location.href == `${HOST}/status` || window.location.href == `${HOST}/status/`) {
  	setTimeout(() => {
	    $.ajax({
	      type: "POST",
	      url: `${HOST}/status/apiGetAll`,
	      beforeSend: function () {
	        $('#statusList .dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
	    },
	      success: function (response) {
	        $('#statusList').DataTable().clear();
	        $('#statusList').DataTable().rows.add(response);
	        $('#statusList').DataTable().draw();
	      },
	      error: function () {
	      	$('#statusList .dataTables_empty').html('Data gagal di retrieve.')
	      },
	      complete: function () {}
	    })
	}, 50)
  }
  $('#statusList').DataTable().on( 'order.dt search.dt', function () {
  	let i = 1;
  	$('#statusList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
  		this.data(i++);
  	});
  }).draw();

  $('form[name="spmb_filter"]').on('submit', function(e) {
    e.preventDefault();
    const unit = $('input[name="unit"]').val();
    const unit2 = $('input[name="unit2"]').val();
    const no = $('input[name="no"]').val();
    const no2 = $('input[name="no2"]').val();
    const deptId = $('input[name="deptId"]').val();
    if(unit == '' || unit2 == '' || no == '' || no2 == '') {
      $('#blankParams .modal-body').html('Parameter tidak boleh kosong.');
      $('#blankParams').modal('show');
    } else {
      $([document.documentElement, document.body]).animate({
          scrollTop: $("#subtitle").offset().top
      }, 500);

      $.ajax({
        type: "POST",
        url: `${HOST}/status/withParams`,
        data: {unit, unit2, no, no2, deptId},
        dataType: "JSON",
        beforeSend: function () {
          $('#statusList').DataTable().clear();
          $('#statusList').DataTable().draw();
        	$('.status-box .stat-param input, .status-box .stat-param button').attr('disabled', true)
        	$('#statusList .dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
        },
        success: function (response) {
        	$('#statusList').DataTable().clear();
          $('#statusList').DataTable().rows.add(response);
          $('#statusList').DataTable().draw();
        },
        error: function () {
        	$('#statusList .dataTables_empty').html('Data gagal di retrieve.')
        },
        complete: function () {
        	$('.status-box .stat-param input, .status-box .stat-param button').attr('disabled', false)
        }
      })
    }

  })

  $('form[name="spmb_filter"] .clear').on('click', function() {
      const unit = $('input[name="unit"]').val();
      const unit2 = $('input[name="unit2"]').val();
      const no = $('input[name="no"]').val();
      const no2 = $('input[name="no2"]').val();
      const deptId = $('input[name="deptId"]').val();
    if(unit == '' || unit2 == '' || no == '' || no2 == '') {
      $('#blankParams .modal-body').html('Belum ada form untuk di clear.');
      $('#blankParams').modal('show');
    } else {
      $([document.documentElement, document.body]).animate({
          scrollTop: $("#subtitle").offset().top
      }, 500);
    	$('form[name="spmb_filter"]')[0].reset();
      $.ajax({
        type: "POST",
        url: `${HOST}/status/apiGetAll`,
        beforeSend: function () {
          $('#statusList').DataTable().clear();
          $('#statusList').DataTable().draw();
          $('.dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
          $('.status-box input, .status-box .stat-param button').attr('disabled', true)
        },
        success: function (response) {
          $('#statusList').DataTable().clear();
          $('#statusList').DataTable().rows.add(response);
          $('#statusList').DataTable().draw();
        },
        error: function () {
        	$('#statusList .dataTables_empty').html('Data gagal di retrieve.')
        },
        complete: function () {
        	$('.status-box input, .status-box .stat-param button').attr('disabled', false)
        }
      })
    }

  })
});