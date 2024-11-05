// Variabel const untuk persentase nilai dan batas kelulusan
const BOBOT_TUGAS = 0.3;
const BOBOT_UTS = 0.3;
const BOBOT_UAS = 0.4;
const BATAS_KELULUSAN = 60;

function hitungNilai() {
  // Get values from inputs
  const nilaiTugas = parseFloat(document.getElementById('nilaiTugas').value);
  const nilaiUts = parseFloat(document.getElementById('nilaiUts').value);
  const nilaiUas = parseFloat(document.getElementById('nilaiUas').value);
  const resultDiv = document.getElementById('result');
  const contributionDiv = document.getElementById('contribution');
  
  // Validasi nilai
  if (isNaN(nilaiTugas) || nilaiTugas < 0 || nilaiTugas > 100 ||
      isNaN(nilaiUts) || nilaiUts < 0 || nilaiUts > 100 ||
      isNaN(nilaiUas) || nilaiUas < 0 || nilaiUas > 100) {
    resultDiv.style.display = 'block';
    resultDiv.className = 'result invalid';
    resultDiv.textContent = 'Masukkan nilai yang valid antara 0 dan 100.';
    contributionDiv.style.display = 'none';
    return;
  }

  // Penghitungan kontribusi berdasarkan persentase nilai
  let kontribusiTugas = nilaiTugas * BOBOT_TUGAS;
  let kontribusiUts = nilaiUts * BOBOT_UTS;
  let kontribusiUas = nilaiUas * BOBOT_UAS;

  // Penghitungan nilai akhir
  let nilaiAkhir = kontribusiTugas + kontribusiUts + kontribusiUas;

  // Determine letter hurufMutu and pass/fail status
  let hurufMutu;
  if (nilaiAkhir >= 90) {
    hurufMutu = 'A';
  } else if (nilaiAkhir >= 80) {
    hurufMutu = 'B';
  } else if (nilaiAkhir >= 70) {
    hurufMutu = 'C';
  } else if (nilaiAkhir >= 60) {
    hurufMutu = 'D';
  } else {
    hurufMutu = 'E';
  }

  // Show results
  resultDiv.style.display = 'block';
  contributionDiv.style.display = 'block';

  // Display individual contributions
  contributionDiv.innerHTML = `
    Kontribusi Tugas: ${kontribusiTugas.toFixed(2)}<br>
    Kontribusi UTS: ${kontribusiUts.toFixed(2)}<br>
    Kontribusi UAS: ${kontribusiUas.toFixed(2)}<br>
    Nilai Akhir: ${nilaiAkhir.toFixed(2)}
  `;

  if (nilaiAkhir >= BATAS_KELULUSAN) {
    resultDiv.className = 'result pass';
    resultDiv.textContent = `Nilai Huruf: ${hurufMutu} - Lulus`;
  } else {
    resultDiv.className = 'result fail';
    resultDiv.textContent = `Nilai Huruf: ${hurufMutu} - Gagal`;
  }

}