export default class Request {

  //Get
  get(url, cb) {
    try {
      // xhr object
      const xhr = new XMLHttpRequest();
      // xhr open
      xhr.open("GET", url);
      // xhr load
      xhr.addEventListener("load", () => {
        if (Math.floor(xhr.status / 100) !== 2) {
          cb(`Error. Status code ${xhr.status}`, xhr);
          return;
        }
        // parse
        const response = JSON.parse(xhr.responseText);
        // callback
        cb(null, response);
      });
      // xhr error
      xhr.addEventListener("error", () => {
        console.log("error");
      });
      // xhr send
      xhr.send();
    } catch (error) {
      console.log(error);
    }
  }

  //Post
  post(url, body, headers, cb) {
    // xhr object
    const xhr = new XMLHttpRequest();
    // xhr open
    xhr.open("POST", url);
    // headers
    if (headers) {
      Object.entries(headers).map(([key, value]) => {
        xhr.setRequestHeader(key, value);
      });
    }
    // xhr load
    xhr.addEventListener("load", () => {
      if (Math.floor(xhr.status / 100) !== 2) {
        cb(`Error. Status code ${xhr.status}`, xhr);
        return;
      }
      // parse
      const response = JSON.parse(xhr.responseText);
      // callback
      cb(null, response);
    });
    // xhr error
    xhr.addEventListener("error", () => {
      console.log("error");
    });
    // xhr send
//    console.log(JSON.stringify(body));
//    xhr.send(JSON.stringify(body));
    xhr.send(body);
  }
}