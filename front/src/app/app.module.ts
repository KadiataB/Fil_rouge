import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';
import {HttpClientModule } from '@angular/common/http';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { CoursComponent } from './cours/cours.component';
import { SessionComponent } from './session/session.component';
import { ListeCoursComponent } from './liste-cours/liste-cours.component';
import { ListeSessionComponent } from './liste-session/liste-session.component';
import { CalendarDateFormatter, CalendarModule, CalendarNativeDateFormatter, DateAdapter, DateFormatterParams } from 'angular-calendar';
import { adapterFactory } from 'angular-calendar/date-adapters/date-fns';
import { InscriptionComponent } from './inscription/inscription.component';


class CustomDateFormatter extends CalendarNativeDateFormatter {
  public override  dayViewHour({date,locale}:DateFormatterParams):string {
    return new Intl.DateTimeFormat(locale,{hour:'numeric',minute:'numeric'}).format(date)
  }

  public override  weekViewHour({date,locale}:DateFormatterParams):string {
    return new Intl.DateTimeFormat(locale,{hour:'numeric',minute:'numeric'}).format(date)
  }
}
@NgModule({
  declarations: [
    AppComponent,
    CoursComponent,
    SessionComponent,
    ListeCoursComponent,
    ListeSessionComponent,
    InscriptionComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule,
    BrowserAnimationsModule,
    CalendarModule.forRoot({ provide: DateAdapter, useFactory: adapterFactory })
  ],
  providers: [
    {provide:CalendarDateFormatter, useClass:CustomDateFormatter}
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
