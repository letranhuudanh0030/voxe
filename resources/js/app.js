/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const slick = require('slick-carousel');
const chained = require('../../node_modules/jquery-chained/jquery.chained');
const slickLightbox = require('slick-lightbox');
const Mmenu = require('mmenu-js');
const Select2 = require('select2')



window.toastr = require('toastr');

toastr.options = {
    "positionClass": "toast-bottom-right",

}


// $(function () {
    
//     $("#city, #district, #ward").select2({
//         theme: 'bootstrap4'
//     });
//     var url = $(location).attr('href'),
//     parts = url.split("/"),
//     last_part = parts[parts.length-1];
//     if(last_part == 'edit'){
//         addressEdit()
//         address()
//     } else {
//         address()
//     }

//     function translate_address(str){
//         if(current_lang == 'en'){
//             let text = del_accent(str);
    
//             text = text.replace(/Thanh pho |Tinh |Quan |Huyen |Thi xa |Phuong |Thi tran |Xa /g, ',')
//             text = text.replace('Quan/Huyen', ', -- District --')
//             text = text.replace('Phuong/Xa', ', -- Ward / Commune --')
    
//             // text = text.replace('Huyen ', 'Province,')
//             // ext = text.substr(0)
//             arr = text.split(',')
//             strConvert = arr[1]
//             // console.log(strConvert)
//             return strConvert
//         } else {
//             // console.log(str)
//             return str
//         }

//     }

//     function address(){
//         axios.get('http://localhost:8000/api/v1/cities')
//         .then((response) => {
//             let city_arr = response.data
//             city_arr.forEach(e => {
//                 let option = new Option(translate_address(e.name), e.code)
//                 $('#city').append(option)
//             });
//             $('#city').change(function(){
//                 let city_id = $(this).children('option:selected').val()
//                 // console.log(city_id)
//                 axios.get(`http://localhost:8000/api/v1/cities/${city_id}/districts`)
//                 .then((response) => {
//                     let district_arr = response.data
//                     $('#district').children('option').remove()
//                     $('#district').append('<option value="">'+translate_address('Quận/Huyện')+'</option>')
//                     district_arr.forEach(e => {                           
//                         let option = new Option(translate_address(e.name), e.code)                       
//                         $('#district').append(option)
//                     });
//                     $('#district').change(function(){
//                         let district_id = $(this).children('option:selected').val()
//                         axios.get(`http://localhost:8000/api/v1/districts/${district_id}/wards`)
//                         .then((response) => {
//                             let ward_arr = response.data
//                             $('#ward').children('option').remove()
//                             $('#ward').append('<option value="">'+translate_address('Phường/Xã')+'</option>')
//                             ward_arr.forEach(e => {
//                                 let option = new Option(translate_address(e.name), e.code)
//                                 $('#ward').append(option)
//                             });
//                         })
//                         .catch(error => console.log(error))
//                     })

//                 })
//                 .catch(error => console.log(error))
//             })
//         })
//         .catch(error => console.log(error));
//     }

//     function addressEdit(){
//         axios.get('http://localhost:8000/api/v1/cities')
//         .then((response) => {
//             let city_arr = response.data
//             let id_edit = $('#city').attr('data-city-id') 
//             city_arr.forEach(e => {
//                 let option = new Option(e.name, e.code)
//                 if(e.code == id_edit){
//                     option = new Option(e.name, e.code, true, true)
//                 }
//                 $('#city').append(option)
//             });
//             $("#city option:selected").ready(function(){
//                 let city_id =  $("#city option:selected").val()
//                 axios.get(`http://localhost:8000/api/v1/cities/${city_id}/districts`)
//                 .then((response) => {
//                     let district_arr = response.data
//                     let id_edit = $('#district').attr('data-district-id') 
//                     $('#district').children('option').remove()
//                     district_arr.forEach(e => {                           
//                         let option = new Option(e.name, e.code)
//                         if(e.code == id_edit){
//                             option = new Option(e.name, e.code, true, true)
//                         }
//                         $('#district').append(option)
//                     });
//                     $("#district option:selected").ready(function(){
//                         let district_id = $("#district option:selected").val()
//                         console.log(district_id)
//                         axios.get(`http://localhost:8000/api/v1/districts/${district_id}/wards`)
//                         .then((response) => {
//                             let ward_arr = response.data
//                             $('#ward').children('option').remove()
//                             ward_arr.forEach(e => {
//                                 let option = new Option(e.name, e.code)
//                                 if(e.code == id_edit){
//                                     option = new Option(e.name, e.code, true, true)
//                                 }
//                                 $('#ward').append(option)
//                             });
//                         })
//                     })
//                 })
//             })
//         })
//     }

//     function del_accent(str) {
//         str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
//         str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
//         str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
//         str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
//         str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
//         str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
//         str = str.replace(/đ/g, "d");
//         str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
//         str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
//         str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
//         str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
//         str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
//         str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
//         str = str.replace(/Đ/g, "D");
//         return str;
//     }


// });
