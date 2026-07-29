<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TechnologyColorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Programming Languages
            ['name' => 'Python', 'color' => '#3776AB'],
            ['name' => 'JavaScript', 'color' => '#F7DF1E'],
            ['name' => 'TypeScript', 'color' => '#3178C6'],
            ['name' => 'PHP', 'color' => '#777BB4'],
            ['name' => 'Java', 'color' => '#007396'],
            ['name' => 'C++', 'color' => '#00599C'],
            ['name' => 'C#', 'color' => '#239120'],
            ['name' => 'Ruby', 'color' => '#CC342D'],
            ['name' => 'Go', 'color' => '#00ADD8'],
            ['name' => 'Rust', 'color' => '#000000'],
            ['name' => 'Swift', 'color' => '#FA7343'],
            ['name' => 'Kotlin', 'color' => '#7F52FF'],
            
            // Frontend
            ['name' => 'HTML', 'color' => '#E34F26'],
            ['name' => 'CSS', 'color' => '#1572B6'],
            ['name' => 'React', 'color' => '#61DAFB'],
            ['name' => 'Vue.js', 'color' => '#4FC08D'],
            ['name' => 'Angular', 'color' => '#DD0031'],
            ['name' => 'Svelte', 'color' => '#FF3E00'],
            ['name' => 'Next.js', 'color' => '#000000'],
            ['name' => 'Nuxt.js', 'color' => '#00DC82'],
            
            // CSS Frameworks
            ['name' => 'Bootstrap', 'color' => '#7952B3'],
            ['name' => 'Tailwind CSS', 'color' => '#06B6D4'],
            ['name' => 'Material-UI', 'color' => '#007FFF'],
            ['name' => 'Chakra UI', 'color' => '#319795'],
            
            // Backend Frameworks
            ['name' => 'Node.js', 'color' => '#339933'],
            ['name' => 'Express', 'color' => '#000000'],
            ['name' => 'Django', 'color' => '#092E20'],
            ['name' => 'Flask', 'color' => '#000000'],
            ['name' => 'Laravel', 'color' => '#FF2D20'],
            ['name' => 'CodeIgniter', 'color' => '#EF4223'],
            ['name' => 'Spring Boot', 'color' => '#6DB33F'],
            ['name' => 'ASP.NET', 'color' => '#512BD4'],
            
            // Databases
            ['name' => 'MySQL', 'color' => '#4479A1'],
            ['name' => 'PostgreSQL', 'color' => '#4169E1'],
            ['name' => 'MongoDB', 'color' => '#47A248'],
            ['name' => 'Redis', 'color' => '#DC382D'],
            ['name' => 'SQLite', 'color' => '#003B57'],
            ['name' => 'MariaDB', 'color' => '#003545'],
            ['name' => 'Oracle', 'color' => '#F80000'],
            ['name' => 'SQL Server', 'color' => '#CC2927'],
            
            // Data Science & ML
            ['name' => 'Pandas', 'color' => '#150458'],
            ['name' => 'NumPy', 'color' => '#013243'],
            ['name' => 'Scikit-learn', 'color' => '#F7931E'],
            ['name' => 'TensorFlow', 'color' => '#FF6F00'],
            ['name' => 'PyTorch', 'color' => '#EE4C2C'],
            ['name' => 'Keras', 'color' => '#D00000'],
            ['name' => 'Jupyter', 'color' => '#F37626'],
            ['name' => 'Matplotlib', 'color' => '#11557C'],
            ['name' => 'Seaborn', 'color' => '#4C8CBF'],
            
            // DevOps & Tools
            ['name' => 'Docker', 'color' => '#2496ED'],
            ['name' => 'Kubernetes', 'color' => '#326CE5'],
            ['name' => 'Git', 'color' => '#F05032'],
            ['name' => 'GitHub', 'color' => '#181717'],
            ['name' => 'GitLab', 'color' => '#FC6D26'],
            ['name' => 'Jenkins', 'color' => '#D24939'],
            ['name' => 'Travis CI', 'color' => '#3EAAAF'],
            ['name' => 'CircleCI', 'color' => '#343434'],
            
            // Cloud Platforms
            ['name' => 'AWS', 'color' => '#FF9900'],
            ['name' => 'Azure', 'color' => '#0078D4'],
            ['name' => 'Google Cloud', 'color' => '#4285F4'],
            ['name' => 'Heroku', 'color' => '#430098'],
            ['name' => 'DigitalOcean', 'color' => '#0080FF'],
            ['name' => 'Vercel', 'color' => '#000000'],
            ['name' => 'Netlify', 'color' => '#00C7B7'],
            
            // Mobile
            ['name' => 'React Native', 'color' => '#61DAFB'],
            ['name' => 'Flutter', 'color' => '#02569B'],
            ['name' => 'Ionic', 'color' => '#3880FF'],
            ['name' => 'Xamarin', 'color' => '#3498DB'],
            
            // Testing
            ['name' => 'Jest', 'color' => '#C21325'],
            ['name' => 'Mocha', 'color' => '#8D6748'],
            ['name' => 'Cypress', 'color' => '#17202C'],
            ['name' => 'Selenium', 'color' => '#43B02A'],
            ['name' => 'Pytest', 'color' => '#0A9EDC'],
            
            // Others
            ['name' => 'GraphQL', 'color' => '#E10098'],
            ['name' => 'REST API', 'color' => '#009688'],
            ['name' => 'Webpack', 'color' => '#8DD6F9'],
            ['name' => 'Vite', 'color' => '#646CFF'],
            ['name' => 'Nginx', 'color' => '#009639'],
            ['name' => 'Apache', 'color' => '#D22128'],
        ];

        // Insert data
        foreach ($data as $tech) {
            // Check if technology already exists
            $exists = $this->db->table('technology_colors')
                ->where('name', $tech['name'])
                ->countAllResults() > 0;
            
            if (!$exists) {
                $this->db->table('technology_colors')->insert([
                    'name'       => $tech['name'],
                    'color'      => $tech['color'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        echo "Technology colors seeded successfully!\n";
    }
}
