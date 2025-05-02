document.getElementById('run-code-form').addEventListener('submit', function(e) {
e.preventDefault();
const runButton = document.getElementById('run-button');
const loader = document.getElementById('loader');
const outputDiv = document.getElementById('run-output');

// Show loading state
runButton.disabled = true;
loader.classList.remove('hidden');
outputDiv.innerText = 'Executing code...';

const formData = new FormData(this);

fetch('/execute-code', {
method: 'POST',
headers: {
'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
'Accept': 'application/json'
},
body: formData
})
.then(response => {
if (!response.ok) {
throw new Error('Network response was not ok');
}
return response.json();
})
.then(data => {
if (data.error) {
outputDiv.innerText = 'Error: ' + data.error;
} else {
outputDiv.innerText = data.output || 'No output';
}
})
.catch(err => {
outputDiv.innerText = 'Error: ' + err.message;
})
.finally(() => {
runButton.disabled = false;
loader.classList.add('hidden');
});
});