import { Component, OnInit } from '@angular/core';


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  title = 'front';
  isConnected: boolean = false;


  ngOnInit() {
    // setInterval(()=>{
      let token = localStorage.getItem('token');

      if (token) {
        this.isConnected = true;
      } else {
        this.isConnected = false;
      }
    // },1000)

  }


}


