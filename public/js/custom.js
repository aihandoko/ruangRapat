const HOST = document.location.origin;

$(function () {

  // let dummyData;

  // $("#dummyStatusList").DataTable({
  //       data: dummyData,
  //       columns: [
  //           {
  //             title: "No",
  //           },
  //           { title: "SPMB" },
  //           { title: "Site" },
  //           { title: "Step1" },
  //           { title: "Step2" },
  //           { title: "Step3" },
  //           { title: "Step4" },
  //           { title: "Step5" },
  //           { title: "Step6" },
  //           { title: "Step7" },
  //       ],
  //       columnDefs: [ {
  //           "searchable": false,
  //           "orderable": false,
  //           "targets": 0
  //       } ],
  //       order: [[ 1, 'asc' ]]
  // });

  // if(window.location.href == `${HOST}/status/tes`) {
  //   $.ajax({
  //     type: "POST",
  //     url: `${HOST}/apis/status/getAll`,
  //     beforeSend: function () {},
  //     success: function (response) {
  //       $('#dummyStatusList').DataTable().clear();
  //       $('#dummyStatusList').DataTable().rows.add(response);
  //       $('#dummyStatusList').DataTable().draw();
  //     },
  //     error: function () {},
  //     complete: function () {}
  //   })
  // }
  // $('#dummyStatusList').DataTable().on( 'order.dt search.dt', function () {
  //       let i = 1;
 
  //       $('#dummyStatusList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
  //           this.data(i++);
  //       } );
  //   } ).draw();

  // $('form[name="dummyShowForm"]').on('submit', function(e) {
  //   e.preventDefault();
  //   const unit = 2
  //   const no = 1;
  //   const deptId = 43
  //   $.ajax({
  //     type: "POST",
  //     url: `${HOST}/apis/status/params`,
  //     dataType: 'JSON',
  //     data: {unit, no, deptId},
  //     beforeSend: function () {
  //       // setTimeout(() => {
  //         $('.status-box .stat-param button[name="submit"]').attr('disabled', true)
  //       // }, 3000)
  //     },
  //     success: function (response) {
  //       $('#dummyStatusList').DataTable().clear();
  //       $('#dummyStatusList').DataTable().rows.add(response);
  //       $('#dummyStatusList').DataTable().draw();
  //     },
  //     error: function () {},
  //     complete: function () {
  //       setTimeout(() => {
  //         $('.status-box .stat-param button[name="submit"]').attr('disabled', false)
  //       }, 3000)
  //     }
  //   })
  // })

  let statusData;
  let queueData;
  let queueDenyData;
  let usersData;

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

  $("#usersList").DataTable({
        data: usersData,
        columns: [
            {title: "#"},
            { title: "NIK" },
            { title: "Nama" },
            { title: "Fungsi" },
            { title: "Site" },
            { title: "Kode SPMB" },
            { title: "CompId" },
            { title: "DeptId" },
        ],
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order: [[ 1, 'asc' ]],
    initComplete: function () {
      const btn = `<a href="#" class="btn btn-primary addUserBtn">Tambah User</a>`;
      $("#usersList_wrapper .dataTables_length").prepend(btn);
    },
  });

  if(window.location.href == `${HOST}/users`) {
    $.ajax({
      type: "POST",
      url: `${HOST}/users/apiGetAll`,
      beforeSend: function () {},
      success: function (response) {
        $('#usersList').DataTable().clear();
        $('#usersList').DataTable().rows.add(response);
        $('#usersList').DataTable().draw();
      },
      error: function () {},
      complete: function () {}
    })
  }
  $('#usersList').DataTable().on( 'order.dt search.dt', function () {
        let i = 1;
 
        $('#usersList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
            this.data(i++);
        } );
    } ).draw();

	$('#usersList_wrapper').on('click', '.addUserBtn', function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: `${HOST}/users/getUsersFungsi`,
      success: function (response) {
        let options = [];
        for(let i = 0;i < response.fungsi.length; i++) {
          options.push('<option value="' + response.fungsi[i] + '">' + response.fungsi[i] + '</option>')
        }
        $('select[name="fungsi"]').html(options.join(''));
        let options2 = [];
        for(let x = 0;x < response.sites.length; x++) {
          options2.push('<option value="' + response.sites[x] + '">' + response.sites[x] + '</option>')
        }
        $('select[name="site"]').html(options2.join(''));
      },
    })
    $('#addUserModal').modal('show')
  })

  $('form[name="addUserForm"]').on('submit', function() {
    const nik = $('input[name="nik"]').val(),
        nama = $('input[name="nama"]').val(),
        fungsi = $('input[name="fungsi"]').val(),
        site = $('input[name="site"]').val(),
        kode_spmb = $('input[name="kode_spmb"]').val(),
        compid = $('input[name="compid"]').val(),
        deptid = $('input[name="deptid"]').val();

    $.ajax({
      type: "POST",
      url: `${HOST}/users/addProcess`,
      data: { nik, nama, fungsi, site, kode_spmb, compid, deptid },
      dataType: "JSON",
      beforeSend: function () {
        $('form[name="addUserForm"] button[name="submit"]').attr('disabled', true);
      },
      success: function (response) {
      },
      error: function () {},
      complete: function () {
        $('form[name="addUserForm"] button[name="submit"]').attr('disabled', false);
      }
    })
  })

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

	$('.sidebar-nav-btn').on('click', 'span', function() {
		$(this).toggleClass('active');
		if($(this).hasClass('active')) {
			$(this).attr('title', 'Klik untuk menghilangkan sidebar')
		} else {
			$(this).attr('title', 'Klik untuk menampilkan sidebar')
		}
		$('.sidebar').toggleClass('hide');
		$('.header-wrapper, .main-wrapper, .app-footer').toggleClass('to-sidebar-hide')
	})

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