function validatePhoneNumber() {

  let phoneNumber = document.getElementById("phone").value;
  let numericPhoneNumber = phoneNumber.replace(/[^\d-]/g, "");
  if (numericPhoneNumber.length === 11) {
    return true;
  } else {
    alert("11桁の半角数字でハイフン抜きで記入してください");
    return false;
  }

}

function validateForm() {

  let message = document.getElementById("message").value;  
  if (message.length < 30) {
    alert("お問い合わせ内容は30文字以上で入力してください。");
    return false;
  }
  
  return true;
  // ↑どういう論理構造？
}