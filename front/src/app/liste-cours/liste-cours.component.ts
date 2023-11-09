import { Component, OnInit } from '@angular/core';
import { ListeC } from '../interfaces/liste';
import { CoursService } from '../services/cours.service';
import Swal from 'sweetalert2'
import { Router } from '@angular/router';

@Component({
  selector: 'app-liste-cours',
  templateUrl: './liste-cours.component.html',
  styleUrls: ['./liste-cours.component.css'],
})
export class ListeCoursComponent implements OnInit {
  cours: ListeC[] = [];
  classes: [] = [];
  constructor(private service: CoursService, private router: Router) {}

  ngOnInit(): void {
    this.coursListe();
  }

  coursListe() {
    this.service.getCours().subscribe((rest) => {
      console.log(rest.data);
      this.cours = rest.data;
    });
  }

  find() {
    let input=document.getElementById("input") as HTMLInputElement;
    console.log(input.value);

    if (input.value =='') {
      this.router.navigate(['/liste-cours']);
    }
    this.service.findByModule(input.value).subscribe((data) =>{
      //console.log(data);
      if(data.message == "voici les cours") {
        this.cours=data.data
      } else {
        this.cours=[]
        Swal.fire({
          title: 'Error!',
          text: "Ce module n'existe pas",
          icon: 'error',
          confirmButtonText: 'Ok'
        });

      }
    })
  }
}
