$("div[class$='box']").click(function() {
   window.location.href = $(this).attr("data-path");
});
