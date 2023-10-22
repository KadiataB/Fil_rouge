import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { Classe } from '../interfaces/classe';
import { Cours } from '../interfaces/cours';
import { CoursClasse } from '../interfaces/cours-classe';
import { ListeC } from '../interfaces/liste';
import { Salle } from '../interfaces/salle';
import { CoursService } from '../services/cours.service';

@Component({
  selector: 'app-session',
  templateUrl: './session.component.html',
  styleUrls: ['./session.component.css'],
})
export class SessionComponent implements OnInit {
  session!: FormGroup;
  salles: Salle[] = [];
  classes: CoursClasse[] = [];
  modes: string[] = [];
  cours: ListeC[] = [];
  c:number=0;
  dat:any;
  display:boolean=true;
  // hd: string = '08:00:00';
  constructor(private service: CoursService, private fb: FormBuilder,private router:Router,private toastr:ToastrService) {
    this.session = this.fb.group({
      salle_id: '',
      classe_id: '',
      cours_id:'',
      mode: '',
      hd: '',
      hf: '',
      date:''
    });
  }

  ngOnInit(): void {
    this.allSalles();
    this.allCours();
  }

  allSalles() {
    this.service.getSalles().subscribe((data) => {
      console.log(data);
      this.salles = data.data;
      this.modes = ['presentiel', 'en_ligne'];
    });
  }

  getClasses() {
    let id=this.session.get("cours_id")?.value;
    console.log(id);

    this.service.allClasses(id).subscribe((data) => {
      console.log(data.data);

      this.classes = data.data;
    });
  }

  allCours() {
    this.service.getCours().subscribe((data) =>{
      console.log(data.data);
     this.cours=data.data
    })
  }

  insertSession() {
    console.log(this.session.value);

    this.service.session(this.session.value).subscribe((response) =>{
      console.log(response);
      this.router.navigate(['/liste-session'])
      this.toastr.success('Session de cours ajouté avec succès');
    },error=>{
      this.toastr.error(error.error.message)
    });

  }

  afficheSalle(event:Event) {

    let e=event.target as HTMLSelectElement;
    // console.log(e.value);
    this.display = e.value==="en_ligne";
    console.log(this.display);


      // if (e.value==="presentiel") {
      //    this.display=true
      //  }
      // if(e.value==="en_ligne") {
      //    this.display=false
      //  }

  }
}
