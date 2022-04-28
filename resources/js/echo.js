window.Echo 
    .channel('hello')
    .listen('SomethingHappend', (e) => {
        alert('TEST');
    });
    
    console.log('XXX');
