import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { Classe } from '../interfaces/classe';
import { CoursService } from '../services/cours.service';

@Component({
  selector: 'app-inscription',
  templateUrl: './inscription.component.html',
  styleUrls: ['./inscription.component.css']
})
export class InscriptionComponent implements OnInit{

  inscription!:FormGroup
  classes:Classe[]=[]
  annee:number=1
  classe_id: any
  file: any
  formData = new FormData()

  constructor(private service:CoursService, private fb:FormBuilder, private toastr: ToastrService) {

  }

 ngOnInit(): void {
     this.getClasses();

 }

  getClasses() {
    this.service.getClasse().subscribe((data)=>{
    console.log(data);
     this.classes=data.data
    })
  }

  selectFile(event: Event)
  {
    const un = event.target as HTMLInputElement;
    this.file = un.files?.[0] as File;
    this.toastr.success("fichier importé")
    console.log(this.classe_id);

    this.formData.append('file', this.file)
    this.formData.append('classe_id', this.classe_id)
    this.formData.append('annee_scolaire_id', '1')
    console.log(this.formData);
  }

  inscrire() {
    this.service.import(this.formData).subscribe((res)=>{
      console.log(res);
      this.toastr.success('Inscription réussie');
    },error=>{
      this.toastr.error(error.error.message)
    })
  }
}
