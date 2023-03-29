function loadCandidate(id) // async
{
    // xHML HTTP request
    var request = new XMLHttpRequest() // 

    request.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#candidates").innerText = this.responseText;
        }
    }
    request.open("GET", "http://localhost/AJAX/getCandidate.php?id=" + id, true)
    console.log("getCandidate.php?id=" + id) 
    request.send()
}

let currentCandidateId = 1;


function nextCandiate() {
    loadCandidate(currentCandidateId++)
    showCookieValue()
}

document.querySelector("#nextCandidate").addEventListener("click", nextCandiate);

const cookieValue = document.cookie
  .split("; ")
  .find((row) => row.startsWith("lastCandidate="))
  ?.split("=")[1];

function showCookieValue() {
  let id = `> ${cookieValue}`;
  console.log(id);
}


loadCandidate(2);
