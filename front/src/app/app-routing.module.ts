import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AttacheComponent } from './attache/attache.component';
import { authGuard } from './auth.guard';
import { ConnexionComponent } from './connexion/connexion.component';
import { CoursComponent } from './cours/cours.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ListeCoursComponent } from './liste-cours/liste-cours.component';
import { ListeSessionComponent } from './liste-session/liste-session.component';
import { ProfesseurComponent } from './professeur/professeur.component';
import { SessionProfComponent } from './session-prof/session-prof.component';
import { SessionComponent } from './session/session.component';

const routes: Routes = [
  {
    path:"",component:ConnexionComponent,
  },
  // {
  //   path:"liste-cou",component:ListeCoursComponent,
  // },
  {
    path:"ajout-cours",component:CoursComponent,

  },
  {
    path:"liste-cours",component:ListeCoursComponent,
    canActivate: [authGuard]
  },
  {
    path:"ajout-session",component:SessionComponent,
    canActivate: [authGuard]
  },
  {
    path:"liste-session",component:ListeSessionComponent,
    canActivate: [authGuard]
  },
  {
    path:"inscription",component:InscriptionComponent,
    canActivate: [authGuard]
  },
  {
    path:"responsable",component:AttacheComponent ,
    canActivate: [authGuard]
  },
  {
    path:"professeur",component:ProfesseurComponent ,
    canActivate: [authGuard]
  },
  {
    path:"session-prof",component:SessionProfComponent ,
    canActivate: [authGuard]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
