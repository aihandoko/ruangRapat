// const HOST = document.location.origin;

$(function () {

  $('.sidebar-nav-btn .burger-icon').tooltip({
    title: function() {
      return ($(this).hasClass('active')) ? 'Hide sidebar' : 'Show sidebar'
    },
  });
  $('.sidebar-nav-btn .burger-icon-mobile').tooltip({title: 'Show sidebar'});

  $('form[name="login"]').on('submit', function(e) {
    e.preventDefault();
    $('form[name="login"] input[name="nik"], form[name="login"] input[name="password"]').removeClass('border-danger')
    const nik = $('input[name="nik"]').val();
    const password = $('input[name="password"]').val();

    $.ajax({
      type: 'POST',
      url: `${HOST}/auth/checkLogin`,
      dataType: 'JSON',
      data: {nik, password},
      beforeSend: function() {
        $('form[name="login"] button[name="submit"], form[name="login"] input[name="nik"], form[name="login"] input[name="password"]').attr('disabled', true);
      },
      success: function(response) {
        if(response.success) {
          window.location.href = response.redirect;
        } else {
          $('form[name="login"] input[name="nik"], form[name="login"] input[name="password"]').addClass('border-danger')
        }
      },
      complete: function() {
        $('form[name="login"] button[name="submit"], form[name="login"] input[name="nik"], form[name="login"] input[name="password"]').attr('disabled', false);
      }
    })
  })


  // STATUS DUMMY
  let dummyData;

  $("#dummyStatusList").DataTable({
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
        order: [[ 1, 'asc' ]]
  });

  if(window.location.href == `${HOST}/status/tes`) {
    $.ajax({
      type: "POST",
      url: `${HOST}/apis/status/getAll`,
      beforeSend: function () {},
      success: function (response) {
        $('#dummyStatusList').DataTable().clear();
        $('#dummyStatusList').DataTable().rows.add(response);
        $('#dummyStatusList').DataTable().draw();
      },
      error: function () {},
      complete: function () {}
    })
  }
  $('#dummyStatusList').DataTable().on( 'order.dt search.dt', function () {
        let i = 1;
 
        $('#dummyStatusList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
            this.data(i++);
        } );
    } ).draw();

  $('form[name="dummyShowForm"]').on('submit', function(e) {
    e.preventDefault();
    const unit = 2
    const no = 1;
    const deptId = 43
    $.ajax({
      type: "POST",
      url: `${HOST}/apis/status/params`,
      dataType: 'JSON',
      data: {unit, no, deptId},
      beforeSend: function () {
        // setTimeout(() => {
          $('.status-box .stat-param button[name="submit"]').attr('disabled', true)
        // }, 3000)
      },
      success: function (response) {
        $('#dummyStatusList').DataTable().clear();
        $('#dummyStatusList').DataTable().rows.add(response);
        $('#dummyStatusList').DataTable().draw();
      },
      error: function () {},
      complete: function () {
        setTimeout(() => {
          $('.status-box .stat-param button[name="submit"]').attr('disabled', false)
        }, 3000)
      }
    })
  })

  let statusData;
  let queueData;
  let queueDenyData;

  $("#statusList").DataTable({
        data: statusData,
        columns: [
            {title: "No"},
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
        order: [[ 1, 'asc' ]]
  });

  if(window.location.href == `${HOST}/status`) {
    $.ajax({
      type: "POST",
      url: `${HOST}/status/apiGetAll`,
      beforeSend: function () {},
      success: function (response) {
        $('#statusList').DataTable().clear();
        $('#statusList').DataTable().rows.add(response);
        $('#statusList').DataTable().draw();
      },
      error: function () {},
      complete: function () {}
    })
  }
  $('#statusList').DataTable().on( 'order.dt search.dt', function () {
        let i = 1;
 
        $('#statusList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
            this.data(i++);
        } );
    } ).draw();

  $('form[name="spmb_filter"]').on('submit', function(e) {
    e.preventDefault();
    const unit = $('input[name="unit"]').val();
    const unit2 = $('input[name="unit2"]').val();
    const no = $('input[name="no"]').val();
    const no2 = $('input[name="no2"]').val();
    const deptId = $('input[name="deptId"]').val();

    $.ajax({
      type: "POST",
      url: `${HOST}/status/withParams`,
      data: {unit, unit2, no, no2, deptId},
      dataType: "JSON",
      beforeSend: function () {
          $('.status-box .stat-param button[name="submit"]').attr('disabled', true)
          $('.status-box .stat-param input[name="unit"], .status-box .stat-param input[name="unit2"], .status-box .stat-param input[name="no"], .status-box .stat-param input[name="no2"], .status-box .stat-param input[name="deptId"]').attr('disabled', true)
      },
      success: function (response) {
        $('#statusList').DataTable().clear();
        $('#statusList').DataTable().rows.add(response);
        $('#statusList').DataTable().draw();
      },
      error: function () {},
      complete: function () {
        $('.status-box .stat-param button[name="submit"]').attr('disabled', false)
          $('.status-box .stat-param input[name="unit"], .status-box .stat-param input[name="unit2"], .status-box .stat-param input[name="no"], .status-box .stat-param input[name="no2"], .status-box .stat-param input[name="deptId"]').attr('disabled', false)
      }
    })
  })

  $("#queueList").DataTable({
        data: queueData,
        columns: [
            {title: "No"},
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
        order: [[ 1, 'asc' ]]
  });

  $("#queueDenyList").DataTable({
        data: queueDenyData,
        columns: [
            {title: "No"},
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
        order: [[ 1, 'asc' ]]
  });

  if(window.location.href == `${HOST}/queue`) {
    $.ajax({
      type: "POST",
      url: `${HOST}/queue/apiGetProcess`,
      beforeSend: function () {},
      success: function (response) {
        $('#queueList').DataTable().clear();
        $('#queueList').DataTable().rows.add(response);
        $('#queueList').DataTable().draw();
      },
      error: function () {},
      complete: function () {}
    })    
    $.ajax({
      type: "POST",
      url: `${HOST}/queue/apiGetDeny`,
      beforeSend: function () {},
      success: function (response) {
        $('#queueDenyList').DataTable().clear();
        $('#queueDenyList').DataTable().rows.add(response);
        $('#queueDenyList').DataTable().draw();
      },
      error: function () {},
      complete: function () {}
    })
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

  

  $(window).on('scroll', function() {
		const position = $(this).scrollTop();
		if(position >= 63) {
			$('.header-wrapper').addClass('fixed');
			$('.main-wrapper').addClass('fixed-to-header');
		} else {
			$('.header-wrapper').removeClass('fixed');
			$('.main-wrapper').removeClass('fixed-to-header');
		}
	})

	$('.sidebar-nav-btn').on('click', '.burger-icon', function() {
		$(this).toggleClass('active');
		$('.sidebar').toggleClass('hide');
		$('.header-wrapper, .main-wrapper, .app-footer').toggleClass('to-sidebar-hide')
	})
  $('.sidebar-nav-btn').on('click', '.burger-icon-mobile', function() {
    $('.sidebar').addClass('on-mobile-show');
    $('.overlay').addClass('show sidebar-mobile');
    $('body').addClass('hidescroll');
  })
  $('#page').on('click', '.overlay.sidebar-mobile', function() {
    $(this).removeClass('show sidebar-mobile');
    $('.sidebar').removeClass('on-mobile-show');
    $('body').removeClass('hidescroll');
  });

	$('.switch-nav .dropdown-item').on('click', function(e) {
		e.preventDefault();
		const key = $(this).attr('data-key');
		$.ajax({
			type: "POST",
			url: `${HOST}/fungsi/changeFungsi`,
			data: {key},
			dataType: "JSON",
			beforeSend: function () {
				$('.overlay').addClass('show')
			},
			success: function (data) {
				$('.overlay').removeClass('show')
				if(data.success) {
					$('.switch-nav .fungsi').html(data.Site + ' - ' + data.Fungsi)
					$('.switch-nav .dropdown-item').removeClass('active')
					$('.switch-nav .dropdown-item:nth-child('+(data.selected_key + 1)+')').addClass('active')
					$('.floating-msg').html('<div class="alert alert-success">Fungsi berhasil diubah</div>').addClass('show')
          window.location.reload();
				} else {
					$('.floating-msg').html('<div class="alert alert-success">Fungsi berhasil diubah</div>').addClass('show')
				}
			},
			error: function () {},
			complete: function () {
				setTimeout(function() {
					$('.floating-msg').html('').removeClass('show');
				}, 3000)
			}
		})
	});

	if (/\/status\/acc\/.*/.test(window.location.href)) {
    $("[id*=acc_notes]").MaxLength({
      MaxLength: 255,
  		CharacterCountControl: $('#display_count')
  	});
  }

  
});