import { Component, OnInit } from '@angular/core';
import { ListeC } from '../interfaces/liste';
import { CoursService } from '../services/cours.service';

@Component({
  selector: 'app-liste-cours',
  templateUrl: './liste-cours.component.html',
  styleUrls: ['./liste-cours.component.css']
})
export class ListeCoursComponent implements OnInit{

  cours:ListeC[]=[];
  classes:[]=[]
constructor(private service:CoursService) {

}

  ngOnInit(): void {
this.coursListe()
  }

  coursListe() {
    this.service.getCours().subscribe((rest)=>{
      console.log(rest.data);
      this.cours=rest.data
     
    })
  }
}
