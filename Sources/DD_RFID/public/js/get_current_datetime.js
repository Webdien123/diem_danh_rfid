// Tính toán tạo biến today lưu ngày hiện tại.
var now = new Date();
var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);
var today = now.getFullYear()+"-"+(month)+"-"+(day);

// Tính toán tạo biến time lưu giờ hiện tại.
var d = new Date();
h = d.getHours();
m = d.getMinutes();
if(h < 10) h = '0' + h; 
if(m < 10) m = '0' + m;
var time = h + ':' + m;