import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { User } from './interfaces/auth';
// import { initFlowbite } from 'flowbite';
import { CoursService } from './services/cours.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  title = 'front';
  isConnected:boolean=false;
  token:string='';
  auth1:boolean=true;
  auth2:boolean=true;
  role:string=''
  user:User= { id:0, name:'', email:'', role:''}

  constructor(private authService:CoursService, public router:Router,private toastr: ToastrService){}

  ngOnInit() {
    let token=localStorage.getItem('token');
    this.user=JSON.parse(localStorage.getItem('user')?.toString()!);
    console.log(this.user.role);
 this.role=this.user.role
    if (token ) {

      this.isConnected=true
    }
    else{
      this.isConnected=false
    }

    // if (this.user.role==="attache") {
    //    this.auth1=true
    //    this.auth2=false
    // }
    // else {
    //   this.auth1===false
    // }
  }


    deconnecter(){
      localStorage.removeItem('token');
      this.toastr.success('Déconnecté(e)')
       this.router.navigate(['/'])
    }
}


