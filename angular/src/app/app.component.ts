import { Component } from '@angular/core';
import { SidebarComponent } from './components/layout/sidebar/sidebar.component';
import { TopbarComponent } from './components/layout/topbar/topbar.component';
import { RouterOutlet } from '@angular/router'; // 👈 Ajout nécessaire

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [SidebarComponent, TopbarComponent, RouterOutlet], // 👈 Import ici !
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'frontend';
}
