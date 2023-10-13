import { Time } from "@angular/common";
import { Classe } from "./classe";
import { Professeur } from "./module-professeur";
import { Semestre } from "./semestre";

export interface ListeC {
  id:number
  heures:number,
  module:string,
  semestre: Semestre[],
  professeur: Professeur,
  classe:Klasse[],

}

export interface Klasse {
  "id":number,
  "heures":string
}

export interface ListeS {
  id: number,
  date: Date,
  hd: Time,
  hf: Time,
  duree:Time,
  attache_id: number,
  cours_classe_id: number,
  etat: string,
  mode: string
}
