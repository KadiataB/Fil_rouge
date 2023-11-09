import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { User } from '../interfaces/auth';
import { CoursService } from '../services/cours.service';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css'],
})
export class NavComponent {

  token: string = '';
  role: string = '';
  user: User = { id: 0, name: '', email: '', role: '' };

  constructor(
    private authService: CoursService,
    public router: Router,
    private toastr: ToastrService
  ) {}

  ngOnInit() {
    const user = JSON.parse(localStorage.getItem('user')?.toString()!);
    console.log(user.role);
    this.role = user.role;


    // if (this.user.role==="attache") {
    //    this.auth1=true
    //    this.auth2=false
    // }
    // else {
    //   this.auth1===false
    // }
  }

  deconnecter() {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    this.toastr.success('Déconnecté(e)');
    this.router.navigate(['/']);
  }
}
