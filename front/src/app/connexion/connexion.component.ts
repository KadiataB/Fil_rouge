import { Component } from '@angular/core';
import { FormBuilder, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { CoursService } from '../services/cours.service';

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['./connexion.component.css']
})
export class ConnexionComponent {

  email=new FormControl('');
  password=new FormControl('');
  token:string=''
  constructor(private fb:FormBuilder, private authService:CoursService, private route:Router, private toastr:ToastrService){ }

  connect= this.fb.group({
    email:['kellyouleye@gmail.com',[Validators.required,Validators.min(8)],],
    password:['kelly0708',Validators.required]
  })


  seConnecter() {
    console.log(this.connect.value);
    let infos = this.connect.value;

    if (infos) {
      this.authService.connexion(infos).subscribe((data) => {
        console.log(data.token);
        console.log(data.user);

        this.token = data.token;
        localStorage.setItem('token',this.token);
        let user =JSON.stringify(data.user)
        localStorage.setItem('user',user)

        if (this.token && data.user.role==='attache') {
          this.route.navigate(['/liste-cours']);
          this.toastr.success("BIENVENUE");

        }
        if(this.token && data.user.role==='responsable') {
          this.route.navigate(['/responsable']);
          this.toastr.success("BIENVENUE");
        }

        if (this.token && data.user.role==='professeur') {
          this.route.navigate(['/professeur']);
          this.toastr.success("BIENVENUE");
         
        }
      },error=>{
        this.toastr.error(error.error.message)

      });
    }
  }


  // stock(user:string) {
  //     let tokens = localStorage.getItem('tokens')?.toString();
  //     // let valeurs: string[] = [];
  //     if (!tokens) {
  //       valeurs.push(user);
  //       localStorage.setItem('tokens', JSON.stringify(valeurs));
  //     } else {
  //       let valeur = JSON.parse(tokens);
  //       valeur.push(user);
  //       localStorage.setItem('tokens', JSON.stringify(valeur));
  //     }
  // }


}



