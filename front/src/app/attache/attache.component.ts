import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { Demande } from '../interfaces/demande';
import { CoursService } from '../services/cours.service';

@Component({
  selector: 'app-attache',
  templateUrl: './attache.component.html',
  styleUrls: ['./attache.component.css']
})
export class AttacheComponent implements OnInit{

  demandes:Demande[]=[]

  constructor(private service:CoursService, private toastr:ToastrService) {}

 ngOnInit(): void {
this.demande()
 }


 demande() {
     this.service.getDemandes().subscribe((data)=>{
      console.log(data.data);
      this.demandes=data.data
     })
 }

 accepter(id:number)  {
  let data={
    etat:"accepte",
    id:id
  }

   console.log(id);

    this.service.demande(data).subscribe((res)=>{
      this.toastr.success(res.message);
      this.demande();
      console.log(res);
    })
 }

 refuser(id:number)  {
  let data={
    etat:"refuse",
    id:id
  }
   this.service.demande(data).subscribe((res)=>{
    this.toastr.error(res.message);
    this.demande();
     console.log(res);

   })
}
}
