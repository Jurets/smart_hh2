// JavaScript Document
//Make it slick!

//Dropdown plugin data
var ddData = [
    {
        text: "English",
        value: 1,
        selected: false,
        imageSrc: "images/logo.png"
    },
    {
        text: "English",
        value: 2,
        selected: false,
        imageSrc: "images/logo.png"
    },
    {
        text: "English",
        value: 3,
        selected: true,
        imageSrc: "images/logo.png"
    },
    {
        text: "English",
        value: 4,
        selected: false,
        imageSrc: "images/logo.png"
    }
];
$(document).ready(function() {
    /*select language*/
    $('#language').ddslick({
        onSelected: function(selectedData) {

            $('#demoDefaultSelection').ddslick({
                data: ddData,
                defaultSelectedIndex: 1
            });
        }
    });
    
    /*slider*/
    $('.imgslider').bxSlider({
        mode: 'fade',
        controls:false,
        pause: 3000,
       // auto: true,
        //autoControls: true,
    
});
    /*slider*/
    $('.bxslider').bxSlider({
        mode: 'fade',
        pager: false,
        responsive:true
        
});
    
//   $('.carousel').carousel({
//  interval: 200000,
//  responsive:true
//}) 
});




