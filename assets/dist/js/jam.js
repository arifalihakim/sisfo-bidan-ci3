window.setTimeout("jam_aktif()", 1000);
function jam_aktif() {
var jam_aktif = new Date();
    setTimeout("jam_aktif()", 1000);
    var jam = jam_aktif.getHours();
    var menit = jam_aktif.getMinutes();
    var detik = jam_aktif.getSeconds();

    //memberikan angka 2 digit untuk 0-9 pada JAM
    if (jam==0) {
        document.getElementById("jam").innerHTML = '0'+jam;
    } else if (jam<10) {
        document.getElementById("jam").innerHTML = '0'+jam;
    } else if (jam==10) {
        document.getElementById("jam").innerHTML = jam_aktif.getHours();
    } else if (jam>10) {
        document.getElementById("jam").innerHTML = jam_aktif.getHours();
    } 

    //memberikan angka 2 digit untuk 0-9 pada MENIT
    if (menit==0) {
        document.getElementById("menit").innerHTML = '0'+menit;
    } else if (menit<10) {
        document.getElementById("menit").innerHTML = '0'+menit;
    } else if (menit==10) {
        document.getElementById("menit").innerHTML = jam_aktif.getMinutes();
    } else if (menit>10) {
        document.getElementById("menit").innerHTML = jam_aktif.getMinutes();
    }

    //memberikan angka 2 digit untuk 0-9 pada DETIK
    if (detik==0) {
        document.getElementById("detik").innerHTML = '0'+detik;
    } else if (detik<10) {
        document.getElementById("detik").innerHTML = '0'+detik;
    } else if (detik==10) {
        document.getElementById("detik").innerHTML = jam_aktif.getSeconds();
    } else if (detik>10) {
        document.getElementById("detik").innerHTML = jam_aktif.getSeconds();
    } 
}