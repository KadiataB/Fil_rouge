import { Component, OnInit } from '@angular/core';
import { Cours } from '../interfaces/cours';
import { ListeC } from '../interfaces/liste';
import { CoursService } from '../services/cours.service';

@Component({
  selector: 'app-professeur',
  templateUrl: './professeur.component.html',
  styleUrls: ['./professeur.component.css']
})
export class ProfesseurComponent implements OnInit{
  cours:ListeC[]=[]
  constructor(private service:CoursService) {}

  ngOnInit(): void {
    this.coursProf();
  }


  coursProf() {
    let user=JSON.parse(localStorage.getItem("user")?.toString()!);
    this.service.coursProf(user.id).subscribe((data)=>{
      console.log(data.data);

      this.cours=data.data
    })
  }

  // profs() {
  //   this.service.profs("professeur").subscribe((data)=>{
  //     console.log(data);

  //   })
  // }
}
