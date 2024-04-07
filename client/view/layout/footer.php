<div class="footer w-[100%] bg-red-100 mt-[32px] flex justify-center">
   <div class="footer-support mx-[16px]">
      <a href="">Tin Tức</a> <br>
      <a href="">Thanh Toán</a> <br>
      <a href="">Giao Hàng</a> <br>
      <a href="baohanh.html">Bảo Hành</a>
   </div>
   <div class="footer-company mx-[16px] py-[16px] ml-[200px]">
      <p>CÔNG TY CỔ PHẦN MOCATO VIỆT NAM <br> - Hotline: 0973.1188.35 <br> - ĐC: 180D Thái Thịnh, P.Láng Hạ,
         Q.Đống Đa, TP.Hà Nội</p>
   </div>

</div>
</div>
<script>
let open_user = document.querySelector(".profile");
let user = document.querySelector(".modal-user");
open_user.addEventListener("click", function() {

   user.classList.toggle("active");
})
</script>

<script>
let open_modal = document.querySelector(" .open");
let modal = document.querySelector(".modal-open");


let close_modal = document.querySelector(".modal-open i")
open_modal.addEventListener("click", function() {
   modal.classList.toggle("active");
})
close_modal.addEventListener("click", function() {
   modal.classList.remove("active")
})
</script>
</body>

</html>