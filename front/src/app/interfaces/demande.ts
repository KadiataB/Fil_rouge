import { Time } from "@angular/common";
import { Classe } from "./classe";
import { Semestre } from "./semestre";

export interface Demande {
  id:number,
  motif:string,
  etat:string,
  session_cours:Session,
  professeur:Professeur

}

export interface User {
  id:number,
  name:string,
  email:string,
  role:string
}

export interface Session {
  id:number
  hd:Time,
  hf:Time,
  mode:string,
  etat:string,
  duree:Duree,
  date:Date,
  cours_classe:Cours_classe
}

export interface Duree {
  "heures":number,
  "minutes":number,
}
export interface Cours_classe {
  id:number,
  classe:Classe,
  cours:Cour
}

export interface Professeur {
  id :number,
  nom:string,
  prenom:string,
  email: string
}


export interface Cour {
  id:number
  module:string,
  heures:number,
  semestre_id: number,
  professeur:Professeur,
  semestre:Semestre[]
}
