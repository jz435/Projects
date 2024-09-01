import pygame
import time
import random




class Player:
    def __init__(self):
        self.floor = 350
        self.rect = pygame.Rect(50, self.floor, 25, 25)
        self.shots = []  
        self.jump_vel = -10  
        self.gravity = 0.8  
        self.is_jumping = False
        self.shot_timer = time.time() 
        self.shot_interval = 0.1  
        


    def shooting(self):
        current_time = time.time()
        if keys[pygame.K_SPACE] and current_time - self.shot_timer >= self.shot_interval:
            mouse_pos = pygame.mouse.get_pos()
            velocity = 5  

            shot_rect = pygame.Rect(self.rect.x, self.rect.y, 5, 5)
            shot_velocity = pygame.Vector2(mouse_pos[0] - self.rect.x, mouse_pos[1] - self.rect.y)
            shot_velocity.normalize_ip()
            shot_velocity *= velocity
            self.shots.append((shot_rect, shot_velocity))

            self.shot_timer = current_time

        for shot, shot_velocity in self.shots:
            pygame.draw.rect(screen, "green", shot)
            shot.x += shot_velocity.x
            shot.y += shot_velocity.y
            if shot.x > 500 or shot.y > 500:  
                self.shots.remove((shot, shot_velocity))


    def movement(self):
        if keys[pygame.K_a]:
            self.rect.x -= 1
        if keys[pygame.K_d]:
            self.rect.x += 1
        if keys[pygame.K_w] and not self.is_jumping:
            self.is_jumping = True
            self.jump_vel = -10

        if self.is_jumping:
            self.rect.y += self.jump_vel
            self.jump_vel += self.gravity

            if self.rect.y >= self.floor:
                self.rect.y = self.floor
                self.is_jumping = False
            

class Enemy:
    def __init__(self):
        self.rect = pygame.Rect(500, player.floor, 50, 25)
        self.health = 100
        

    def damage(self):
        for shot, _ in player.shots:
            if self.rect.colliderect(shot):
                print(self.health)
                self.health -= 10
                player.shots.remove((shot, _))
                if self.health <= 0:
                    print("Enemy defeated!")

    def enemy_movement(self):
        if self.health > 0:
            self.rect.x -= 1
        
        if self.health <= 0:
            self.rect.x = 500
            self.health = 100

    def render_health(self, screen):
        health_text = font.render("HP: " + str(self.health), True, (255, 255, 255))
        health_text_rect = health_text.get_rect()
        health_text_rect.center = (self.rect.x + self.rect.width // 2, self.rect.y - 20)
        screen.blit(health_text, health_text_rect)


class FallingObjects:
    def __init__ (self):
        self.rect = pygame.Rect(100, 20, 25, 25)
        self.health = 100

    def fallingobjects(self):
        self.rect.y += 1
        if self.rect.y >= 500:
            self.rect = pygame.Rect(100, 20, 50, 25)

        if self.rect.colliderect(player.rect):
            print("Hit")

        
        
            





player = Player()
enemy = Enemy()
falling = FallingObjects()

pygame.init()
pygame.mixer.Sound('skotteffekt.mp3')

default_font = pygame.font.get_default_font()
font = pygame.font.Font(default_font, 16)

screen = pygame.display.set_mode((500, 500))
clock = pygame.time.Clock()
running = True

while running:
    
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            running = False

    
    
    screen.fill("purple")
    
 
    keys = pygame.key.get_pressed()
    player.movement()
    player.shooting()

    falling.fallingobjects()
    enemy.damage()
    enemy.enemy_movement()
    enemy.render_health(screen)
    

    pygame.draw.rect(screen, "red", player.rect)
    pygame.draw.rect(screen, "white", enemy.rect)
    pygame.draw.rect(screen, "white", falling.rect)

    
    pygame.display.update()

    clock.tick(60)  

pygame.quit()