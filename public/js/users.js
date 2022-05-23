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
      const btn = `<a href="#" data-toggle="tooltip" title="Reload data tanpa cache" class="btn btn-success reload-users"><i class="fas fa-sync"></i></a> <a href="${HOST}/users/create" class="btn btn-primary btn-add mr-2">Tambah User</a>`;
      $("#usersList_wrapper .dataTables_length").prepend(btn);
    },
  });

  if(window.location.href == `${HOST}/users` || window.location.href == `${HOST}/users/`) {
    setTimeout(() => {
      $.ajax({
      type: "POST",
      url: `${HOST}/users/apiGetAll`,
      beforeSend: function() {
        $('#usersList .dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
      },
      success: function (response) {
        $('#usersList').DataTable().clear();
        $('#usersList').DataTable().rows.add(response);
        $('#usersList').DataTable().draw();
      },
      error: function() {
        $('#usersList .dataTables_empty').html('Data gagal di retrieve.')
      },
      complete: function () {}
    })
    }, 50)
  }
  $('#usersList').DataTable().on( 'order.dt search.dt', function () {
    let i = 1;
    $('#usersList').DataTable().cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
      this.data(i++);
    });
  }).draw();

  $('.reload-users').on('click', function(e) {
    e.preventDefault();
    const refresh = true;
    $.ajax({
      type: "POST",
      url: `${HOST}/users/apiGetAll`,
      dataType: 'JSON',
      data: {refresh},
      beforeSend: function() {
        $('#usersList').DataTable().clear();
        $('#usersList').DataTable().draw();
        $('#usersList .dataTables_empty').html('<div class="spinner-icon"><span class="spinner-grow text-info"></span><span class="caption">Fetching data...</span></div>')
      },
      success: function (response) {
        $('#usersList').DataTable().clear();
        $('#usersList').DataTable().rows.add(response);
        $('#usersList').DataTable().draw();
      },
      error: function() {
        $('#usersList .dataTables_empty').html('Data gagal di retrieve.')
      },
      complete: function () {}
    })
  });

  $('.addUserForm').on('submit', function(e) {
  	$(".addUserForm input, .addUserForm select, .addUserForm option, .addUserForm textarea").prop('readonly',true);
  	$(".addUserForm button").prop('disabled',true);
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