const HOST = document.location.origin;

$(function () {

	const statusData = $("#statusList").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: `${HOST}/status/apiGetAll`,
      type: "POST",
      data: function (d) {
        // d.validity = $('select[name="valid-filter"]').val();
      },
    },
    order: [],
    createdRow: function (row, data, dataIndex) {
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
    columns: [
      {
        orderable: false,
        order: [],
        render: function (data, type, full, meta) {
          return meta.settings._iDisplayStart + meta.row + 1;
        },
        width: "25px",
      },
      {
      	render: function (data, type, full, meta) {
      		return `<a href="${HOST}/status/detail/${full.SPMBNo}">${full.SPMBNo}</a>`
        },
      },
      { data: "Site", width: "140px" },
      {
      	render: function (data, type, full, meta) {
      		const dateStep1 = (full.DateConverted[0] != null) ? '<div class="acc-date">' + full.DateConverted[0] + '</div>' : '';
        	return (full.Step1 != null) ? full.Step1 + dateStep1 : '';
        },
      },
      {
      	render: function (data, type, full, meta) {
      		const dateStep2 = (full.DateConverted[1] != null) ? '<div class="acc-date">' + full.DateConverted[1] + '</div>' : '';
        	return (full.Step2 != null) ? full.Step2 + dateStep2 : '';
        },
      },
      {
      	render: function (data, type, full, meta) {
      		const dateStep3 = (full.DateConverted[2] != null) ? '<div class="acc-date">' + full.DateConverted[2] + '</div>' : '';
        	return (full.Step3 != null) ? full.Step3 + dateStep3 : '';
        },
      },
      {
      	render: function (data, type, full, meta) {
      		const dateStep4 = (full.DateConverted[3] != null) ? '<div class="acc-date">' + full.DateConverted[3] + '</div>' : '';
        	return (full.Step4 != null) ? full.Step4 + dateStep4 : '';
        },
      },
      {
      	render: function (data, type, full, meta) {
      		const dateStep5 = (full.DateConverted[4] != null) ? '<div class="acc-date">' + full.DateConverted[4] + '</div>' : '';
        	return (full.Step5 != null) ? full.Step5 + dateStep5 : '';
        },
      },
      {
      	render: function (data, type, full, meta) {
      		const dateStep6 = (full.DateConverted[5] != null) ? '<div class="acc-date">' + full.DateConverted[5] + '</div>' : '';
        	return (full.Step6 != null) ? full.Step6 + dateStep6 : '';
        },
      },
      {
      	render: function (data, type, full, meta) {
      		const dateStep7 = (full.DateConverted[6] != null) ? '<div class="acc-date">' + full.DateConverted[6] + '</div>' : '';
        	return (full.Step7 != null) ? full.Step7 + dateStep7 : '';
        },
      },
    ],
    initComplete: function () {
    },
  });

	$("#usersList").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: `${HOST}/users/apiGetAll`,
      type: "GET",
      data: function (d) {
        // d.validity = $('select[name="valid-filter"]').val();
      },
    },
    order: [],
    createdRow: function (row, data, dataIndex) {
      $(row).find("td:eq(1)").attr("data-label", "NIK");
      $(row).find("td:eq(2)").attr("data-label", "Nama");
      $(row).find("td:eq(3)").attr("data-label", "Fungsi");
      $(row).find("td:eq(4)").attr("data-label", "Site");
      $(row).find("td:eq(5)").attr("data-label", "KodeSPMB");
      $(row).find("td:eq(6)").attr("data-label", "DeptId");
      $(row).find("td:eq(7)").attr("data-label", "CompId");
    },
    columns: [
      {
        orderable: false,
        order: [],
        render: function (data, type, full, meta) {
          return meta.settings._iDisplayStart + meta.row + 1;
        },
        width: "25px",
      },
      { data: "NIK" },
      { data: "Nama" },
      { data: "Fungsi" },
      { data: "Site" },
      { data: "KodeSPMB" },
      { data: "DeptId" },
      { data: "CompId" },
    ],
    initComplete: function () {
    },
  });

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

  $('form[name="spmb_filter"]').on('submit', function(e) {
    e.preventDefault();
    const unit = $('input[name="unit"]').val();
    const unit2 = $('input[name="unit2"]').val();
    const no = $('input[name="no"]').val();
    const no2 = $('input[name="no2"]').val();
    const deptId = $('input[name="deptId"]').val();
    
    // statusData.ajax.url(`${HOST}/status/withParams`).load();

    $.ajax({
      type: "POST",
      url: `${HOST}/status/withParams`,
      data: {unit, unit2, no, no2, deptId},
      dataType: "JSON",
      beforeSend: function () {
        $('.status-box .stat-param button[name="submit"]').attr('disabled', true)
      },
      success: function (response) {
        console.log(JSON.parse(response));
        $('#statusList').DataTable().clear();
        $('#statusList').DataTable().rows.add(JSON.parse(response.data));
        $('#statusList').DataTable().draw();
      },
      error: function () {},
      complete: function () {
        $('.status-box .stat-param button[name="submit"]').attr('disabled', false)
      }
    })
  })
});