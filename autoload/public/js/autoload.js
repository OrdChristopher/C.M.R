window.onload = asynchronous_json_request ( 'public/javascript/autoload.json', onload );

function onload ( scripts = [ ] ) {
  if ( scripts.length > 0 ) {
    var head = document.getElementsByTagName ( 'head' ) [ 0 ];
    for ( var key in scripts ) {
      script = document.createElement ( 'script' );
      script.type = 'text/javascript';
      script.src = scripts [ key ];
      script.async = false;
      head.appendChild ( script );
    }
  }
}

function asynchronous_json_request ( url, callback ) {
  var xmlhttprequest = new XMLHttpRequest ( );
  xmlhttprequest.onreadystatechange = function ( ) { 
    if ( xmlhttprequest.readyState == 4 && xmlhttprequest.status == 200 ) {
      callback ( JSON.parse ( xmlhttprequest.responseText ) );
    }
  }
  xmlhttprequest.open ( "GET", url, true );
  xmlhttprequest.send ( );
}