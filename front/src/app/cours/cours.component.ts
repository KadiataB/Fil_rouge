import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { CoursService } from '../services/cours.service';
import { OnInit } from '@angular/core';
import { Classe } from '../interfaces/classe';
import { Semestre } from '../interfaces/semestre';
import { Module } from '../interfaces/module';
import { ModuleProfesseur, Professeur } from '../interfaces/module-professeur';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import Swal from 'sweetalert2'
@Component({
  selector: 'app-cours',
  templateUrl: './cours.component.html',
  styleUrls: ['./cours.component.css']
})
export class CoursComponent implements OnInit{

  cours!:FormGroup;
  classes:Classe[]=[];
  semestres:Semestre[]=[];
  modules:Module[]=[];
  mods:ModuleProfesseur[]=[]
  profs:any;
   regex:RegExp = /^[1-9]\d?$|^100$/;

  constructor(private fb:FormBuilder, private service:CoursService,private toastr: ToastrService,private router:Router) {

  this.cours=this.fb.group({

    heures:[0,Validators.pattern(this.regex)],
    module_id:[1,[Validators.required]],
    semestre_id:[1,[Validators.required]],
    classe_id:[1,[Validators.required]],
    professeur_id:[1,[Validators.required]]
  })
  }
ngOnInit(): void {
   this.getSemestres();
   this.getclasses();
    this.getModules();
}

  insertCours() {
    console.log(this.cours.value);
    this.service.insertCours(this.cours.value).subscribe((res)=>{
      console.log(res);
      this.router.navigate(['/liste-cours'])
      Swal.fire({
        title: 'Success!',
        text: 'Do you want to continue',
        icon: 'success',
        confirmButtonText: 'Cool'
      })
      // this.toastr.success('Cours ajouté avec succès');

    })

  }



  getclasses() {
   this.service.getClasse().subscribe((data)=>{
     console.log(data.data);
     this.classes=data.data

   })
  }

  getSemestres() {
     this.service.getSemestre().subscribe((data)=>{
      console.log(data.data);

      this.semestres=data.data
     })
  }
  getModules() {
    return this.service.getModule().subscribe((data)=>{
      console.log(data.data);

      this.modules=data.data
    })
  }
  getProfs() {
    let id=this.cours.get('module_id')?.value;
       this.service.getProfesseur(id).subscribe((data)=>{
        this.mods=data.data
        this.mods.forEach(p=>{
          this.profs= p.professeur;
          console.log(p);
        })
      })
  }



}
