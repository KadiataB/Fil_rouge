import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CoursComponent } from './cours/cours.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ListeCoursComponent } from './liste-cours/liste-cours.component';
import { ListeSessionComponent } from './liste-session/liste-session.component';
import { SessionComponent } from './session/session.component';

const routes: Routes = [
  {
    path:"",component:ListeCoursComponent,
  },
  {
    path:"ajout-cours",component:CoursComponent,
  },
  {
    path:"liste-cours",component:ListeCoursComponent
  },
  {
    path:"ajout-session",component:SessionComponent
  },
  {
    path:"liste-session",component:ListeSessionComponent
  },
  {
    path:"inscription",component:InscriptionComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
