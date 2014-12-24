$(function () {
    if ($('select').is('#slot1') === true) {
        SLOTS.initialSystem();
    }
    if( $('div').is('#exists') === true ) {
        SLOTS.modulation.slots();
    }
});
// Namespace for ticket creation form
var SLOTS = {
    slotsQuantity: 0,
    modulation : {
        slots: function(){
            var instruction = JSON.parse($('#exists').html());
            var currentSlotNumber = 1;
            for (var category in instruction){
                this.slotChange(currentSlotNumber, category);
                currentSlotNumber ++;
            }
        },
        slotChange: function(currentSlotNumber, category){
            $('#slot'+currentSlotNumber+' option').each(function(){
                if( $(this).attr('name') == category) {
                    $(this).attr('selected', 'selected');
                    $(this).change();
                }
            });
        },
    },
    catalogue: {
        choisesStorage: [],
        category: {
            name: '',
            sign: {
                id: 0,
                value: ''
            },
            signCollection: [],
            categoryInit: function () {
                this.name = 'category';
                var catlist = $('.lvl1');
                for (var i = 0; i < catlist.size(); i++) {
                    this.sign.id = catlist[i].id;
                    this.sign.value = catlist[i].childNodes[0].nodeValue;
                    this.signCollection.push(SLOTS.copyer(this.sign));
                }
            },
            renderSlots: function () {
                var matrix = this.slotPrepare();
                for (var i = 1; i <= SLOTS.slotsQuantity; i++)
                    $('#slot' + i).html(matrix);
            },
            slotPrepare: function () {
                var nodes = "<option>Select if you need</option>\n";
                for (var i = 0; i < this.signCollection.length; i++) {
                    nodes = nodes + '<option name="' + this.signCollection[i].id + '">' + this.signCollection[i].value + '</option>\n';
                }
                return nodes;
            }
        },
        slotInit: function () {
            for (i = 1; i <= SLOTS.slotsQuantity; i++) {
                $("#slot" + i).change(this.slotOnChange);
                this.choisesStorage[i] = undefined;
            }
        },
        // warning!
        slotOnChange: function () {
            /* the key method */
            var choise = $(this).find('option:selected');
            var slot = $(this).attr('id');
            var index = parseInt(slot.substr(4));
            SLOTS.catalogue.choisesStorage[index] = choise.attr('name');
            SLOTS.catalogue.slotOtherRerender(index);
            SLOTS.catalogue.panelSubcatRender(index, SLOTS.catalogue.choisesStorage[index]);
            if(SLOTS.catalogue.choisesStorage[index] === undefined){
                $('#addon'+index).empty();
            }
        },
        slotOtherRerender: function (current) {
            for (i = 1; i <= SLOTS.slotsQuantity; i++) {
                if (i === current)
                    continue;
                $('#slot' + i).find('option').css('display', 'block');
                for (j = 1; j <= SLOTS.slotsQuantity; j++) {
                    $('#slot' + i).find('option[name="' + SLOTS.catalogue.choisesStorage[j] + '"]').css('display', 'none');
                }
            }
        },
        panelSubcatRender: function (slot, category) {
            var address = parseInt(category) - 1;
            if (isNaN(address)) {
                $('#pnl' + slot).empty();
            } else {
                this.panelProceed(address, slot);
            }
        },
        panelProceed: function (addr, slot) {
            var matrix = '';
            var source = SLOTS.catalogue.category.signCollection[addr];
            matrix = matrix + '<input type="checkbox" name="' + SLOTS.catalogue.category.name + '[' + source.id + ']">' + '<label>' + slot + '. ' + source.value + '</label>\n';
            matrix = matrix + '<ul class="select-sub-categories">\n';
            var buffer = $('#' + source.id).find('.lvl2');
            for (var i = 0; i < buffer.size(); i++) {
                matrix = matrix + '<li><input type="checkbox" name="' + SLOTS.catalogue.category.name + '[' + buffer[i].id + ']">';
                matrix = matrix + '<label>' + buffer[i].innerHTML + '</label></li>\n';
            }
            matrix = matrix + '</ul>';
            var panel = $('#pnl' + slot).html(matrix);
            panel.find('input[type="checkbox"]').change(this.renderFormAddons);
        },
        renderFormAddons: function () {
            var pnl_id = $(this).closest('li[id^=pnl]').attr('id');
            var num_id = pnl_id.substr(3);
            if ($(this).is(':checked')) {
                // insert
                $('#addon'+num_id).append('<input type="hidden" name="'+this.name+'">');
            } else {
                // delete
                $('#addon'+num_id).find('input[name="'+this.name+'"]').remove();
            }
        }
    },
    /* services */
    initialSystem: function () {
        SLOTS.slotsQuantity = $('#slotsquantity').html();
        SLOTS.catalogue.category.categoryInit();
        SLOTS.catalogue.category.renderSlots();
        SLOTS.catalogue.slotInit();
    },
    copyer: function (obj) {
        var buff = {};
        for (var tar in obj) {
            buff[tar] = obj[tar];
        }
        return buff;
    }
};

