$(function () {
	"use strict";
	/* perfect scrol bar */
	new PerfectScrollbar('.header-message-list');
	new PerfectScrollbar('.header-notifications-list');
	// search bar
	$(".mobile-search-icon").on("click", function () {
		$(".search-bar").addClass("full-search-bar");
	});
	$(".search-close").on("click", function () {
		$(".search-bar").removeClass("full-search-bar");
	});
	$(".mobile-toggle-menu").on("click", function () {
		$(".wrapper").addClass("toggled");
	});
	// toggle menu button
	$(".toggle-icon").click(function () {
		if ($(".wrapper").hasClass("toggled")) {  
			// unpin sidebar when hovered
			$(".wrapper").removeClass("toggled");
			$(".sidebar-wrapper").unbind("hover");
		} else {
			$(".wrapper").addClass("toggled");
			$(".sidebar-wrapper").hover(function () {
				$(".wrapper").addClass("sidebar-hovered");
			}, function () {
				$(".wrapper").removeClass("sidebar-hovered");
			})
		}
	});
	/* Back To Top */
	$(document).ready(function () {
		$(window).on("scroll", function () {
			if ($(this).scrollTop() > 300) {
				$('.back-to-top').fadeIn();
			} else {
				$('.back-to-top').fadeOut();
			}
		});
		$('.back-to-top').on("click", function () {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});
	$(function () {
		for (var i = window.location, o = $(".metismenu li a").filter(function () {
			return this.href == i;
		}).addClass("").parent().addClass("");;) {
			if (!o.is("li")) break;
			o = o.parent("").addClass("").parent("").addClass("");
		}
	}),

	// metismenu
	$(document).ready(function(){
		$(function () {
			$('#menu').metisMenu().show()
		});
		});
	//Reports DataTables
	$(document).ready(function() {
		// Create date inputs
	   
		var table = $('#report').DataTable( {
			lengthChange: false,
			dom: 'Blfrtip',
			buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
		} );
	 
		table.buttons().container()
			.appendTo( '#example_wrapper .col-md-6:eq(0)' );
			// Refilter the table
  
	} );
	
	//Visitors Reports Filter
	$(document).ready(function() {
		$("#applyFilter").click(function() {
		  var startDate = new Date($("#start-date").val());
		  var endDate = new Date($("#end-date").val());
		  var office = $("#office").val().toLowerCase();
		  var host = $("#host").val().toLowerCase();
	  
		  $("table tbody tr").filter(function() {
			var rowDate = new Date($(this).find("td:nth-child(7)").text().trim());
			var rowOffice = $(this).find("td:nth-child(5)").text().toLowerCase();
			var rowHost = $(this).find("td:nth-child(4)").text().toLowerCase();
	  
			var dateMatch = (isNaN(startDate) || isNaN(endDate) || (rowDate >= startDate && rowDate <= endDate));
			var officeMatch = (office === "" || rowOffice === office);
			var hostMatch = (host === "" || rowHost === host);
	  
			return !(dateMatch && officeMatch && hostMatch);
		  }).hide();
	  
		});
		$("#resetFilter").on("click", function() { // listen for clicks on the reset filter button
			$("#start-date").val(""); // reset the start date filter select to its default value
			$("#end-date").val(""); // reset the end date filter select to its default value
			$("#office").val(""); // reset the department filter select to its default value
			$("#host").val(""); // reset the host filter select to its default value
			$("table tbody tr").show(); // show all rows
	  });
	  });
	//Dynamic Dropdown
	$(document).ready(function() {
		$('#department_id').change(function() {
			var departmentId = $(this).val();
			if (departmentId) {
				$.ajax({
					url: '/staff-members/' + departmentId,
					type: 'GET',
					dataType: 'json',
					success: function(data) {
						$('#staff_member_id').empty();
						$('#staff_member_id').append($('<option>').text('Select Staff Member').attr('value', ''));
						$.each(data, function(key, value) {
							$('#staff_member_id').append($('<option>').text(value.name).attr('value', value.id));
						});
					}
				});
			}
		});
	});
	//Appointments Table Edit appointment date
	$(document).ready(function() {
		// Initialize DataTable
		var appointmentsTable = $('#appointmentTable').DataTable();
	
		// Handle click on appointment date cell
		$('#appointmentTable tbody').on('click', 'td.editable', function() {
		  var cell = $(this);
		  var appointmentId = cell.data('id');
		  var appointment_date = cell.data('field');
		  var currentValue = cell.text();
		  var token = $('meta[name="csrf-token"]').attr('content');
	
		  // Replace cell content with input field
		  cell.html('<input type="date" id="date" class="form-control" name="' + appointment_date + '" value="' + currentValue + '">');
	
		  // Focus on input field
		  cell.find('input').focus();
		
	
		  // Handle blur on input field
		  cell.find('input').on('blur', function() {
			var newValue = $(this).val();
	
			// Update cell content with new value
			cell.text(newValue);
	
			// Send AJAX request to update appointment date in database
			$.ajax({
			  url: '/appointments/' + appointmentId,
			  method: 'PUT',
			  data: {
				field: appointment_date,
				value: newValue,
				_token: token
			  },
			  success: function(response) {
				// Show success message
				alert(response);
			  },
			  error: function(jqXHR, textStatus, errorThrown) {
				// Show error message
				alert('Error: ' + errorThrown);
			  }
			});
		  });
		});
	  });
	  $(document).ready(function () {
		$('.appointment-date').on('blur', function () {
		  var appointmentId = $(this).data('appointment-id');
		  var newDateValue = $(this).text();
		  var token = $('meta[name="csrf-token"]').attr('content');
	  
		  $.ajax({
			url: '/appointments/' + appointmentId,
			type: 'PUT',
			data: {
			  field: 'appointment_date',
			  value: newDateValue,
			  _token: token
			},
			success: function (response) {
			  console.log(response);
			},
			error: function (xhr) {
			  console.log(xhr.responseText);
			}
		  });
		});
	  });
	  
//GET EMPLOYEES BY DEPARTMENT



	// chat toggle
	$(".chat-toggle-btn").on("click", function () {
		$(".chat-wrapper").toggleClass("chat-toggled");
	});
	$(".chat-toggle-btn-mobile").on("click", function () {
		$(".chat-wrapper").removeClass("chat-toggled");
	});
	// email toggle
	$(".email-toggle-btn").on("click", function () {
		$(".email-wrapper").toggleClass("email-toggled");
	});
	$(".email-toggle-btn-mobile").on("click", function () {
		$(".email-wrapper").removeClass("email-toggled");
	});
	// compose mail
	$(".compose-mail-btn").on("click", function () {
		$(".compose-mail-popup").show();
	});
	$(".compose-mail-close").on("click", function () {
		$(".compose-mail-popup").hide();
	});
	/*switcher*/
	$(".switcher-btn").on("click", function () {
		$(".switcher-wrapper").toggleClass("switcher-toggled");
	});
	$(".close-switcher").on("click", function () {
		$(".switcher-wrapper").removeClass("switcher-toggled");
	});
	$("#lightmode").on("click", function () {
		$('html').attr('class', 'light-theme');
	});
	$("#darkmode").on("click", function () {
		$('html').attr('class', 'dark-theme');
	});
	$("#semidark").on("click", function () {
		$('html').attr('class', 'semi-dark');
	});
	$("#minimaltheme").on("click", function () {
		$('html').attr('class', 'minimal-theme');
	});
	$("#headercolor1").on("click", function () {
		$("html").addClass("color-header headercolor1");
		$("html").removeClass("headercolor2 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8");
	});
	$("#headercolor2").on("click", function () {
		$("html").addClass("color-header headercolor2");
		$("html").removeClass("headercolor1 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8");
	});
	$("#headercolor3").on("click", function () {
		$("html").addClass("color-header headercolor3");
		$("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8");
	});
	$("#headercolor4").on("click", function () {
		$("html").addClass("color-header headercolor4");
		$("html").removeClass("headercolor1 headercolor2 headercolor3 headercolor5 headercolor6 headercolor7 headercolor8");
	});
	$("#headercolor5").on("click", function () {
		$("html").addClass("color-header headercolor5");
		$("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor3 headercolor6 headercolor7 headercolor8");
	});
	$("#headercolor6").on("click", function () {
		$("html").addClass("color-header headercolor6");
		$("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor3 headercolor7 headercolor8");
	});
	$("#headercolor7").on("click", function () {
		$("html").addClass("color-header headercolor7");
		$("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor3 headercolor8");
	});
	$("#headercolor8").on("click", function () {
		$("html").addClass("color-header headercolor8");
		$("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor3");
	});


});