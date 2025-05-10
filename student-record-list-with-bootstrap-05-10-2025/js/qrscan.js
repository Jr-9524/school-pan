document.addEventListener("DOMContentLoaded", () => {
  const html5QrCode = new Html5Qrcode("qr-video");
  document.getElementById('start_scan').style.display = 'none'; 
  const selectedSubject = document.getElementById('subject_select').value;
  const selectedSection = document.getElementById('section_select').value;

  let scanStopped = false;

  function startScanning(){
    html5QrCode.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: { width: 250, height: 250} },
      (qrCodeMessage) => {
        if (!scanStopped) {
          document.getElementById('qr_Text').value = qrCodeMessage;

          setTimeout(() => {
            document.getElementById('qrForm').submit();
          }, 2000);
          
          console.log(`QR Code detected: ${qrCodeMessage}`);
          console.log(`Selected subject: ${selectedSubject}`);
          console.log(`Selected section: ${selectedSection}`);

          scanStopped = true;

          setTimeout(() => {
            scanStopped = false;
            startScanning();
          }, 5000);
        }
      }
    )
  }
  startScanning();
});