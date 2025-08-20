  function showLoading(id) {
            document.getElementById(`loading-${id}`).classList.remove('hidden');
            document.getElementById(`text-${id}`).textContent = "Processing...";
            document.getElementById(`btn-${id}`).disabled = true;
        }

        function hideLoading(id, originalText) {
            document.getElementById(`loading-${id}`).classList.add('hidden');
            document.getElementById(`text-${id}`).textContent = originalText;
            document.getElementById(`btn-${id}`).disabled = false;
        }

        function downloadAsPNG() {
            showLoading('png');
            const element = document.getElementById("exportArea");

            html2canvas(element, {
                scale: 2,
                useCORS: true
            }).then(canvas => {
                const link = document.createElement("a");
                link.download = "payment-details.png";
                link.href = canvas.toDataURL("image/png");
                link.click();

                hideLoading('png', 'Download as PNG');
            });
        }

        async function downloadAsPDF() {
            showLoading('pdf');
            const {
                jsPDF
            } = window.jspdf;
            const element = document.getElementById("exportArea");

            const canvas = await html2canvas(element, {
                scale: 2,
                useCORS: true
            });
            const imgData = canvas.toDataURL("image/png");

            const pdf = new jsPDF({
                orientation: 'landscape',
                unit: 'px',
                format: [canvas.width, canvas.height]
            });

            pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
            pdf.save("payment-details.pdf");

            hideLoading('pdf', 'Download as PDF');
        }
