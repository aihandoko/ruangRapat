$(function () {

	let usersData;

	$("#usersList").DataTable({
        data: usersData,
        columns: [
            {title: "#", width: 25},
            { title: "NIK" },
            { title: "Nama", width: 170 },
            { title: "Fungsi" },
            { title: "Site" },
            { title: "Kode SPMB" },
            { title: "CompId", width: 65 },
            { title: "DeptId" },
            { title: "&nbsp;", "orderable": false, width: 40 },
        ],
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order: [[ 1, 'asc' ]],
    createdRow: function (row, data, dataIndex) {
      $(row).find("td:eq(0)").attr("data-label", "No");
      $(row).find("td:eq(1)").attr("data-label", "NIK");
      $(row).find("td:eq(2)").attr("data-label", "Nama");
      $(row).find("td:eq(3)").attr("data-label", "Fungsi");
      $(row).find("td:eq(4)").attr("data-label", "Site");
      $(row).find("td:eq(5)").attr("data-label", "Kode SPMB");
      $(row).find("td:eq(6)").attr("data-label", "CompId");
      $(row).find("td:eq(7)").attr("data-label", "DeptId");
    },
    initComplete: function () {
      const btn = `<a href="${HOST}/users/create" class="btn btn-primary btn-add mr-2">Tambah User</a>`;
      $("#usersList_wrapper .dataTables_length").prepend(btn);
    },
  });

  if(window.location.href == `${HOST}/users` || window.location.href == `${HOST}/users/`) {
  	loadData({
  		beforeSend: function() {},
  		success: function (response) {
  			$('#usersList').DataTable().clear();
  			$('#usersList').DataTable().rows.add(response);
  			$('#usersList').DataTable().draw();
  		}
  	});
  }
  $('#usersList').DataTable().on( 'order.dt search.dt', function () {
    let i = 1;
    $('#usersList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
      this.data(i++);
    });
  }).draw();

	// $('#usersList_wrapper').on('click', '.addUserBtn', function(e) {
 //    e.preventDefault();
 //    $.ajax({
 //      type: "POST",
 //      url: `${HOST}/users/getUsersFungsi`,
 //      success: function (response) {
 //        let options = [];
 //        for(let i = 0;i < response.fungsi.length; i++) {
 //          options.push('<option value="' + response.fungsi[i] + '">' + response.fungsi[i] + '</option>')
 //        }
 //        $('select[name="fungsi"]').html(options.join(''));
 //        let options2 = [];
 //        for(let x = 0;x < response.sites.length; x++) {
 //          options2.push('<option value="' + response.sites[x] + '">' + response.sites[x] + '</option>')
 //        }
 //        $('select[name="site"]').html(options2.join(''));
 //      },
 //    })
 //    $('#addUserModal').modal({show: true, backdrop: 'static'})
 //  })

  $('.addUserForm').on('submit', function(e) {
  	$(".addUserForm input, .addUserForm select, .addUserForm option, .addUserForm textarea").prop('readonly',true);
  	$(".addUserForm button").prop('disabled',true);
    // e.preventDefault();
    // const nik = $('input[name="nik"]').val(),
    //     nama = $('input[name="nama"]').val(),
    //     fungsi = $('select[name="fungsi"]').val(),
    //     site = $('select[name="site"]').val(),
    //     kode_spmb = $('input[name="kode_spmb"]').val(),
    //     compid = $('input[name="compid"]').val(),
    //     deptid = $('input[name="deptid"]').val();

    // $.ajax({
    //   type: "POST",
    //   url: `${HOST}/users/addProcess`,
    //   data: { nik, nama, fungsi, site, kode_spmb, compid, deptid },
    //   dataType: "JSON",
    //   beforeSend: function () {
    //     $("input, select, option, textarea, button", 'form[name="addUserForm"]').prop('disabled',true);
    //     $('.submit-indicator').html('<span class="spinner-border spinner-border-sm" role="status"></span>Mengirimkan data...')
    //   },
    //   success: function (response) {
    //     if(response.success) {
    //       $('.floating-msg').addClass('show').html('<div class="alert alert-success">Data berhasil ditambahkan</div>');
    //       $('#addUserModal').modal('hide')
    //     } else {
    //       $('#addUserModal .modal-body').prepend('<div class="alert alert-danger">' + response.msg + '</div>')
    //       if(response.validation.hasOwnProperty('NIK')) {
    //         $('form[name="addUserForm"] input[name="nik"]').addClass('border-danger');
    //       }
    //       if(response.validation.hasOwnProperty('Nama')) {
    //         $('form[name="addUserForm"] input[name="nama"]').addClass('border-danger');
    //       }
    //     }
    //   },
    //   error: function () {},
    //   complete: function () {
    //     setTimeout(() => {
    //     	$('.floating-msg').removeClass('show').html('');
    //     }, 3000)
    //       $('#addUserModal').modal('hide')
    //       $("input, select, option, textarea, button", 'form[name="addUserForm"]').prop('disabled',false);
    //       $('.submit-indicator').html('');
    //       loadData({
    //       	beforeSend: function() {},
    //       	success: function (response) {
    //       		$('#usersList').DataTable().clear();
    //       		$('#usersList').DataTable().rows.add(response);
    //       		$('#usersList').DataTable().draw();
    //       	}
    //       });
    //   }
    // })
  })
  $('#addUserModal').on('hide.bs.modal', function (event) {
    $('form[name="addUserForm"]')[0].reset();
  })

  $('#usersList').on('click', '.user-edit', function(e) {
  	e.preventDefault();
  	const nik = $(this).attr('data-id');
  	$('#addUserModal .modal-title').html('Edit User')
  	$('#addUserModal').modal({show: true, backdrop: 'static'})
  	console.log(nik);
  	// $.ajax({
   //    type: "POST",
   //    url: `${HOST}/users/apiGetAll`,
   //    beforeSend: paramObj.beforeSend,
   //    success: paramObj.success,
   //    error: function () {},
   //    complete: function () {}
   //  })
  })

});

function loadData(paramObj) {
	$.ajax({
      type: "POST",
      url: `${HOST}/users/apiGetAll`,
      beforeSend: paramObj.beforeSend,
      success: paramObj.success,
      error: function () {},
      complete: function () {}
    })
}