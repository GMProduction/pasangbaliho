// let today = new Date().toISOString().substr(0, 10);
// document.querySelector("#today").value = today;

$(document).ready(function(){
    setInterval( hideLoading, 3000);
})

function hideLoading() {
    $('#loading').addClass('hide');
    $('#detailSH').removeClass('hide');
    // Remove listener to re-enable scroll
window.removeEventListener('scroll', noScroll);
}
function noScroll() {
  window.scrollTo(0, 0);
}

// add listener to disable scroll
window.addEventListener('scroll', noScroll);

function tgl() {
    var a = $('#mulai').val();
    var dates = new Date(a);
    var hs = dates.getDate();
    var bs = dates.getMonth()+2;
    var ts = dates.getFullYear();
    if(bs<10){bs='0'+bs}
    if(hs<10){hs='0'+hs}
    var tse = ts+'-'+bs+'-'+hs;
    dates.setDate(dates.getDate() + 31);
    document.querySelector("#selesai").valueAsDate = dates;
    $('#selesai').attr('min',tse);
}

    var dates = new Date();
    var hs = dates.getDate();
    var bs = dates.getMonth()+2;
    var ts = dates.getFullYear();
    if(bs<10){bs='0'+bs}
    if(hs<10){hs='0'+hs}
    var tse = ts+'-'+bs+'-'+hs;
    dates.setDate(dates.getDate() + 31);
    document.querySelector("#selesai").valueAsDate = dates;
    $('#selesai').attr('min',tse);

var date = new Date();

var h = date.getDate()+3;
var b = date.getMonth()+1;
var t = date.getFullYear();

if(b<10){b='0'+b}
if(h<10){h='0'+h}



var te = t+'-'+b+'-'+h;

date.setDate(date.getDate() + 3);

document.querySelector("#mulai").valueAsDate = date;
$('#mulai').attr('min',te);

// $('#today2').value(d);

function testClient() {
    Swal.fire({
  title: 'Peringatan !',
  text: "Client tidak dapat melakukan permintaan penawaran",
  icon: 'warning',
 
})
}
    function test() {
           
            Swal.fire({
  title: 'Peringatan !',
  text: "Silahkan Login / Register sebagai Advertiser untuk meminta penawaran harga",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Register',
  confirmButtonText: 'Login'
}).then((result) => {
  if (result.value) {
    window.location = '/login'
  }else if(
    result.dismiss === Swal.DismissReason.cancel
  ){
    window.location = '/registration'
  }
})
        }