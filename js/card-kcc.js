
var cardTypes = { Visa: '001', Mastercard: '002', JCB: '007' };

var getCybsCardType = function(typeName) {
	return cardTypes[typeName];
};

var getExpiry = function(mm, yy) {
	return (mm.length == 2 && yy.length == 2) ? mm + '-20' + yy : '';
};

$(document).ready(function() {
	console.log( "ready!" );
	$("#container-card").show();
});

$('.name').attr('style', 'text-transform: uppercase');
$(".englishonly").on("keypress", function(event) {

	var ALPHA_NUMERIC_SPACE = /[A-Za-z0-9 ]/g;
	var key = String.fromCharCode(event.which);

	if (event.keyCode == 8  || event.keyCode == 37 ||
			event.keyCode == 39 || ALPHA_NUMERIC_SPACE.test(key)) {
			return true;
	}

	return false;
});

$('.englishonly').on("paste", function(e) {
	e.preventDefault();
});

$('#frmCard').submit(function() {
	return updateCardValue();
});

function updateCardValue() {

	var myCard      = $('#my-card');
	//var cardNumber  = (myCard.CardJs('cardNumber')).replace(/ /g, '');
	var cardNumber  = CardJs.numbersOnlyString(myCard.CardJs('cardNumber'));
	var cardType    = myCard.CardJs('cardType');
	var name        = myCard.CardJs('name');
	var expiryMonth = myCard.CardJs('expiryMonth');
	var expiryYear  = myCard.CardJs('expiryYear');
	var cvc         = myCard.CardJs('cvc');

	cybsCardType    = getCybsCardType(cardType);
	expiry          = getExpiry(expiryMonth, expiryYear);

	console.log(cybsCardType);

	$("#card_type").val(cybsCardType);
	$("#card_number").val(cardNumber);
	$("#card_name").val(name);
	$("#card_expiry").val(expiry);
	$("#card_cvn").val(cvc);

	return true;
}

function getBase64FromImageUrl(url) {

	var img = new Image();
	img.setAttribute('crossOrigin', 'anonymous');

	img.onload = function () {
			var canvas = document.createElement("canvas");
			canvas.width = this.width;
			canvas.height = this.height;

			var ctx = canvas.getContext("2d");
			ctx.drawImage(this, 0, 0);

			var dataURL = canvas.toDataURL("image/png");
			console.log(dataURL);
			//console.log(dataURL.replace(/^data:image\/(png|jpg);base64,/, ""));
	};

	img.src = url;
}