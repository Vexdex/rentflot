$(document).ready(function () {

if (window.odessa_redirect == 'true') {
$("body").addClass("Odessa");
}

var dhref = window.location.href;
if (dhref.length > 27) {
console.log("inside");
}

var sw = parseInt(screen_width());
if (sw < 768 ) {
$("#menu_motor_ships").removeAttr("href");
$(".left_ships_menu_item a:first").addClass("nopointer");
$("#sub_menu_odessa_yachts").closest("tr").addClass("lmenu2");
}
});


/* монитор адаптации */ 
$(document).ready(function () {
jQuery("body").append("<span class='jsmonitor'></span>");
siteDemMonitor();

});

$(window).load(function(){
addClass();
var sw = parseInt(screen_width());
if (sw < 768 ) {
var right_side_content = $(".table3tr2td3").html();
var rsc = '<div class="rsc">'+right_side_content+'</div>';
var rsc2 = '<div class="rsc2">'+right_side_content+'</div>';
$(".table3tr2td1").append(rsc); // для планшета переносим контент правой боковины в левую боковину
$(".table3tr2td3").remove();
$(".table3tr2td2").show();
$(".rsc").show();

$("#mibew-agent-button img").attr("src","http://rentflot.fes.org.ua/images/ocm.png");
$("#mibew-agent-button img").css({"top":"-150px","position":"relative"});

var left_topmenu = $(".left_topmenu").html();
$(".left_topmenu_bottom td").append(left_topmenu);
$(".left_topmenu_bottom td").append(rsc2);
console.log(rsc2);
}  
$("body").addClass("ready");
});


$(window).resize(function(){
siteDemMonitor();
});

function siteDemMonitor(){
$(".jsmonitor").html("");
//var ww = parseInt($(window).width());
var wh = parseInt($(window).height());
var fww = screen_width();
$(".jsmonitor").append("<p>width: "+fww+"px</p>");
$(".jsmonitor").append("<p>height: "+wh+"px</p>");

if (fww > 767 && fww < 1130) {
$(".jsmonitor").append("tablet");
}
if (fww < 767) {
$(".jsmonitor").append("mobile");
}
}
/* END монитор адаптации */ 

/* ширина экрана */ 
function screen_width(){
var ww = parseInt($(window).width());
var sw = parseInt(getScrollbarWidth());
var fww = ww+sw;
return fww;
}
/* END ширина экрана */ 

/* Ширина скроллбара браузера */ 
 function getScrollbarWidth() {
    var outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.width = "100px";
    outer.style.msOverflowStyle = "scrollbar"; 

    document.body.appendChild(outer);

    var widthNoScroll = outer.offsetWidth;
    // force scrollbars
    outer.style.overflow = "scroll";

    // add innerdiv
    var inner = document.createElement("div");
    inner.style.width = "100%";
    outer.appendChild(inner);        
    var widthWithScroll = inner.offsetWidth;
    outer.parentNode.removeChild(outer);
    return widthNoScroll - widthWithScroll;
}
/* END Ширина скроллбара браузера */ 


function addClass(){
$("table:eq(0)").addClass("table0"); // глобальная таблица 1 
$("table:eq(1)").addClass("table1"); // глобальная таблица 2
$("table:eq(1) tr:eq(0)").addClass("table1tr0"); // шапка
$(".table1tr0").next("tr").addClass("table1tr1"); // якорная цепь под шапкой
$(".table1tr1").next("tr").addClass("table1tr2"); // контент
$(".table1tr2").next("tr").addClass("table1tr3");
$(".table1tr3").next("tr").addClass("table1tr4");
$(".table1tr4").next("tr").addClass("table1tr5");
$(".table1tr5").next("tr").addClass("table1tr6");
$("table:eq(2)").addClass("table2");

$("table:eq(2) td:eq(0)").addClass("table2td1");
$(".table2td1").next("td").addClass("table2td2");
$(".table2td2").next("td").addClass("table2td3");

$(".table1tr2 table:eq(0)").addClass("table3"); // контент
$(".table3 tr:eq(0)").addClass("table3tr1"); // иконки над контентом
$(".table3tr1").next("tr").addClass("table3tr2"); // контент
$(".table3tr1 td:eq(0)").addClass("table3tr1td0");
$(".table3tr2 td:eq(0)").addClass("table3tr2td1"); // левая боковина контента 
$(".table3tr2td1").next("td").addClass("table3tr2td2"); // середина контента
$(".table3tr2td2").next("td").addClass("table3tr2td3"); // правая боковина контента
$(".table2td3 table tr:eq(1) td:eq(0)").addClass("table2td3td3");

$("h3.descr_block").next("div").addClass("photos_list");
$(".contacts_section img:first").addClass("logo");

$(".prod_img").each(function(){
$(this).closest("td").addClass("shop_item");
$(this).closest("td").find("table:eq(0)").addClass("info");
});






$(".attraction_img_count").each(function(){
$(this).closest("td").removeClass("shop_item").addClass("attraction_item");
});

$(".left_ships_menu").each(function(){
$(this).closest("td").addClass("left_ships_menu_item");
});

$(".table3tr2td3 table:eq(0)").addClass("table3tr2td3tbl1");
$(".table3tr2td3 table:eq(1)").addClass("table3tr2td3tbl2");
$(".table3tr2td3tbl2 td:eq(0)").addClass("table3tr2td3tbl2td1");
$(".table3tr2td3tbl2td1 td:eq(0)").addClass("table3tr2td3tbl2td1td1");
$(".table1tr3 td:eq(0)").addClass("table1tr3td1");
$(".table1tr6 td:eq(0)").addClass("table1tr6td1");
$(".table3tr2td2 table:eq(0)").addClass("table3tr2td2tbl1").addClass("table3tr2td2tbl");
$(".table3tr2td2 table:eq(0)").next().addClass("table3tr2td2tbl2").addClass("table3tr2td2tbl");

if ($(".photos_list").length > 0) {
$(".prod_img").closest("div").addClass("item_card_main_photo");
$(".prod_img").closest(".shop_item").addClass("item_card");
$(".photos_list").closest("tr").next("tr").addClass("item_card_gallery_bottom");
}

if ($(".gallery").length > 0) {
var mt = $(".gallery").closest(".main_text");
var sb = mt.find("#vkshare0");
var st = sb.closest("table").addClass("vkt");
var stt = $(".vkt").closest("td").closest("table");
stt.addClass("w100");
}
$(".contacts_section iframe").closest("tr").addClass("mtd");
$(".contacts_section").closest(".main_text").addClass("csw");
$(".csw img:first").addClass("cl");
$(".table3tr2td1 table:eq(0)").addClass("table3tr2td1tbl1");
$(".table3tr2td1tbl1").next("table").addClass("table3tr2td1tbl2");

$("h1.content.banquet").closest(".main_text").addClass("banquet");
$("h1.content.rest_walk").closest(".main_text").addClass("rest_walk");
$("h1.content.odessa1").closest(".main_text").addClass("odessa1");
$("h1.content.clients").closest(".main_text").addClass("clients");
$("h1.content.entertaiments").closest(".main_text").addClass("entertaiments");
$("h1.content.attractions").closest(".main_text").addClass("attractions");
$("h1.content.about").closest(".main_text").addClass("about");
$("h1.content.payment").closest(".main_text").addClass("payment");
$("h1.content.paths").closest(".main_text").addClass("paths");
$("h1.content.homepage").closest(".main_text").addClass("homepage");

$(".StdBlockLT").each(function(){
var rstc = $(this).closest("div");
rstc.closest("td").addClass("rsttd");
});

$(".shop_table .shop_item").each(function(){
$(this).next("td").addClass("rp");
});

$(".table3tr2td3tbl1 tr:eq(0)").next("tr").next("tr").addClass("reviews");
$(".table3tr2td3tbl1 tr:eq(0)").next("tr").addClass("payments");
var rwtext = $(".table3tr2td3tbl1 .reviews h3").text();
var rwlink = '<a href="/clients.html" title="">'+rwtext+'</a>';
$(".table3tr2td3tbl1 .reviews h3").html(rwlink);

$(".table3tr2td3tbl1 tr:eq(0)").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").addClass("news");

$(".table3tr2td3tbl1 tr:eq(0)").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").addClass("links");

$(".table3tr2td3tbl1 .links table tr:eq(0)").next("tr").addClass("tr2");
$(".table3tr2td3tbl1 .links .tr2").next("tr").addClass("tr3");
$(".table3tr2td3tbl1 .links .tr3").next("tr").addClass("tr4");
$(".table3tr2td3tbl1 .links .tr4").next("tr").addClass("tr5");

//$(".table1tr6td1 table td:eq(1)").addClass("footer_copy");


$(".photos_list").closest("td").addClass("photos_list_td");

$(".photos_list_td a[name='item_photos']").addClass("photos_list_anchor");
$("a[name='top']").addClass("totop_anchor");

$("div.view_info").closest("td").addClass("view_info_wrap_td");
$("div.view_info").closest("table").addClass("view_info_wrap_table");

$(".lightbox-gal-1.nobor").closest(".shop_table").addClass("pg2");

/*
$(".table3tr2td3tbl1 tr:eq(0)").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").addClass("hide");
$(".table3tr2td3tbl1 tr:eq(0)").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").addClass("hide");
$(".table3tr2td3tbl1 tr:eq(0)").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").addClass("hide").addClass("dshow");

$(".table3tr2td3tbl1 tr:eq(0)").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").next("tr").addClass("hide");
*/

if (window.odessa_redirect == 'true') {
if ($(".odessa_rent_types").length > 0){
var odessa_rent_types = $(".odessa_rent_types").clone();
$(".odessa_rent_types").remove();
odessa_rent_types.insertAfter(".table3tr2td2tbl2");
}
}


}

