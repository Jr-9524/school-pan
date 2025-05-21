document.addEventListener("DOMContentLoaded", () => {
  const html5QrCode = new Html5Qrcode("qr-video");
  let scanStopped = false;
  let lastScannedCode = '';

  function saveAttendance(qrCodeMessage, selectedSection, selectedSubjectCode) {
    fetch('attendance_save.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `qr_Text=${encodeURIComponent(qrCodeMessage)}&subject-code=${encodeURIComponent(selectedSubjectCode)}&section=${encodeURIComponent(selectedSection)}`
    })
    .then(response => response.text())
    .then(data => {
      document.getElementById('result').innerHTML = data; 
    })
    .catch(error => console.error('Error:', error));
  }

  function fetchAttendanceRecords(section, subjectCode) {
    const formData = new FormData();
    formData.append("section", section);
    formData.append("subject-code", subjectCode);

    // Fetch the attendance records
    fetch('liveattendance.php', {
      method: 'POST',
      body: formData,
    })
    .then(response => response.text())
    .then(html => {
      // Insert the returned HTML into the table body
      const tableBody = document.querySelector('table tbody');
      tableBody.innerHTML = html;  
    })
    .catch(error => console.error('Error fetching records:', error));
  }

  function startScanning(){
    if (!html5QrCode){
      html5QrCode = new html5QrCode("qr-video");
    }

    html5QrCode.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: { width: 250, height: 250 } },
      (qrCodeMessage) => {
        if (!scanStopped && qrCodeMessage !== lastScannedCode) {
          scanStopped = true;

          lastScannedCode = qrCodeMessage;
          document.getElementById('qr_Text').value = qrCodeMessage;  // set the QR code text in the input field

          //get the section and subcode value
          const selectedSection = document.getElementById('section_select').value; 
          const selectedSubjectCode = document.getElementById('subject_select').value; 

          saveAttendance(qrCodeMessage, selectedSection, selectedSubjectCode);
          fetchAttendanceRecords(selectedSection, selectedSubjectCode);  // Fetch updated attendance records
        }
        
        setTimeout(() => {
          scanStopped = false;
          startScanning();
        }, 2000);
      }
    );
  }

  startScanning();
});
