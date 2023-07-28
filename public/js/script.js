const statusCheckbox = document.getElementById('statusCheckbox');
const statusCheckboxValue = document.getElementById('statusCheckboxValue');

statusCheckbox.addEventListener('change', function() {
    if(this.checked) {
        statusCheckboxValue.value = '1';
    } else {
        statusCheckboxValue.value = '0';
    }
});



// const editBookSelect = document.getElementById('edit-book-select');

// function populateFields(bookId) {
//     fetch('/book/${bookId}')
//         .then(response => response.json())
//         .then(book => {
//             document.getElementById('title').value = book.title;
//             document.getElementById('isbn').value = book.isbn;
//             document.getElementById('description').value = book.description;
//             document.getElementById('pages').value = book.pages;
//             document.getElementById('year_of_publication').value = book.year_of_publication;
//             //document.getElementById('publisher_id').value = book.publisher_id;
//         })
//         .catch(error => {
//             console.error('Error fetching book data:', error);
//             document.getElementById('title').value = '';
//             document.getElementById('isbn').value = '';
//             document.getElementById('description').value = '';
//             document.getElementById('pages').value = '';
//             document.getElementById('year_of_publication').value = '';
//             //document.getElementById('publisher_id').value = '';
//         });
// }

// editBookSelect.addEventListener('change', () => {
//     const bookId = editBookSelect.value;
//     populateFields(bookId);
// });