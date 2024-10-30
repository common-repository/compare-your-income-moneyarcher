if (jQuery(".cyi_html").length > 0) {
  var cyiFaceSize = 120;
  var cyiForegroundColor = jQuery("#cyiGraphColor").val();
  var cyiSalTime = parseInt(jQuery("#cyiSalTime").val());

  resizeCyi();
  jQuery(window).on("resize", function() {
    resizeCyi();
  });

  cyiGeneratePercentage(0);
}

function resizeCyi() {
  var cyiHtmlWidth = jQuery(".cyi_html").width();
  cyiHtmlWidth = Number.isInteger(cyiHtmlWidth) ? cyiHtmlWidth : 601;
  if (cyiHtmlWidth < 950 && cyiHtmlWidth >= 600) {
    cyiFaceSize = 100;
  } else if (cyiHtmlWidth < 600) {
    cyiFaceSize = 50;
  }
}

jQuery("#cyi_input_text").on("input", function() {
  var income = this.value;
  income = parseFloat(income) ? parseFloat(income) : 0;
  cyiGeneratePercentage(income);
});

function cyiGeneratePercentage(income) {
  var cyiIdList = cyiIds();
  var sal = null;
  var inPercentage = 0;
  var pNum = null;
  var daysToEarnTheSal = null;

  cyiIdList.forEach((elm, index) => {
    sal = jQuery(elm).data("sal");
    sal = parseInt(sal);
    inPercentage = income * (100 / sal);
    if (inPercentage < 1) {
      inPercentage = inPercentage.toFixed(2);
    } else {
      inPercentage = parseInt(inPercentage);
    }
    jQuery(elm).data("parcent", inPercentage);

    pNum = ".cyi-parcentage-number_" + (index + 1);

    daysToEarnTheSal = (cyiSalTime / sal) * income;
    daysToEarnTheSal = daysToEarnTheSal.toFixed(2);
    jQuery(pNum).text(daysToEarnTheSal);
  });
  updateCyi(cyiIdList);
}
function cyiIds() {
  var maxCyiPeople = 5;
  var cyiIds = [];
  var cyiId = null;

  for (var i = 1; i <= maxCyiPeople; i++) {
    cyiId = ".cyi-bar_" + i;
    cyiIds.push(cyiId);
  }
  return cyiIds;
}

function updateCyi(cyiIds) {
  cyiIds.forEach(elm => {
    jQuery(elm).cyiImgProgress({
      size: cyiFaceSize,
      backgroundColor: "#E5E5E5",
      foregroundColor: cyiForegroundColor
    });
  });
}
