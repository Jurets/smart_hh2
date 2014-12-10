$(function(){
    if($('select').is('#slot1') === true){
        // TO DO Runtime Circle
    }
    SLOTS.slotsQuantity = $('#slotsquantity').html();
    SLOTS.catalogue.category.categoryInit();
    SLOTS.catalogue.category.renderSlots();
    SLOTS.catalogue.slotInit();
});
// Namespace for ticket creation form
var SLOTS = {    
    slotsQuantity : 0,
    catalogue : {
        category : {
            name : '',
            sign : {
                id: 0,
                value : ''
            },
            signCollection : [],
        categoryInit : function(){
            this.name = 'category';
            var catlist = $('.lvl1');
            for(var i = 0; i < catlist.size(); i++){
                this.sign.id = catlist[i].id;
                this.sign.value = catlist[i].childNodes[0].nodeValue;
                this.signCollection.push(SLOTS.copyer(this.sign));
            }
        },
        renderSlots : function(){
            var matrix = this.slotPrepare();
            for(var i = 1; i <= SLOTS.slotsQuantity; i++)
            $('#slot'+i).html(matrix);
        },
        slotPrepare : function(){
            var nodes = "<option>Select if you need</option>\n";
            for(var i = 0; i < this.signCollection.length; i++){
                nodes = nodes + '<option name="'+this.signCollection[i].id+'">'+this.signCollection[i].value+'</option>\n';
            }
            return nodes;
        }
        },
        slotInit : function(){
           for(i = 1; i <= SLOTS.slotsQuantity; i++){
               $("#slot"+i).change(this.slotOnChange);
           }  
        },
        slotOnChange : function(){
           var choise = $(this).find('option:selected');
           var slot = $(this).attr('id');
           console.log(choise.attr('name') + ' : ' + choise.val() + ' slot? ' + slot);
        }
    },
    copyer : function(obj){
        var buff = {};
        for(var tar in obj){
            buff[tar] = obj[tar];
        }
        return buff;
    }
}; 

