const pdfViewer = document.getElementById('pdf-viewer');
const currentPageSpan = document.getElementById('current-page');
const totalPagesSpan = document.getElementById('total-pages');
const prevPageButton = document.getElementById('prev-page');
const nextPageButton = document.getElementById('next-page');

let pdfDocument = null;
let currentPage = 1;

const renderPDF = (pdfUrl) => {
    // Load the PDF document
    PDFJS.getDocument(pdfUrl).then(doc => {
        pdfDocument = doc;
        totalPagesSpan.textContent = doc.numPages;

        // Render the first page
        renderPage(currentPage);
    });
};

const renderPage = (pageNumber) => {
    // Get the specified page
    pdfDocument.getPage(pageNumber).then(page => {
        // Create a canvas element to render the page on
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Set the canvas size to match the page size
        const viewport = page.getViewport(1);
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        // Render the page to the canvas
        page.render(ctx, viewport);

        // Clear the existing content in the PDF viewer
        pdfViewer.innerHTML = '';

        // Append the canvas to the PDF viewer container
        pdfViewer.appendChild(canvas);

        // Update the current page indicator
        currentPage = pageNumber;
        currentPageSpan.textContent = `Page ${pageNumber}`;

        // Update the page controls
        prevPageButton.disabled = (pageNumber === 1);
        nextPageButton.disabled = (pageNumber === pdfDocument.numPages);
    });
};

// Handle file input change
const fileInput = document.getElementById('file-input');
fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const url = URL.createObjectURL(file);
    renderPDF(url);
});

// Handle page navigation
