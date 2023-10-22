import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { ListeS } from '../interfaces/liste';
import { CoursService } from '../services/cours.service';

@Component({
  selector: 'app-session-prof',
  templateUrl: './session-prof.component.html',
  styleUrls: ['./session-prof.component.css']
})
export class SessionProfComponent implements OnInit {

  sessions:any[]=[];
  kadia:any;
  motif:string=""
constructor(private service:CoursService , private toastr:ToastrService) {}

ngOnInit(): void {
this.sessionsProf()
}

 sessionsProf() {
  let user=JSON.parse(localStorage.getItem("user")?.toString()!);
  this.service.sessionsProf(user.id).subscribe((data)=>{
    console.log(data.data);
    this.sessions=data.data

  })
 }

 annulation() {
  console.log(this.kadia.id);
// console.log(this.motif);


  let demande= {
    motif:this.motif,
    session_cours_id:this.kadia.id,
    professeur_id:this.kadia.cours_classe.cours.professeur.id
  }
  console.log(demande);


  this.service.demande(demande).subscribe((data)=>{
    this.toastr.success(data.message)
  },error=>{
    this.toastr.error(error.error.message)
  })

 }

 modal(s:any) {
  this.kadia=s

  let mod=document.getElementById("staticModal");
  mod!.style.display="block";

 }
}
