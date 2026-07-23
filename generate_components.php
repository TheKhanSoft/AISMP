<?php
declare(strict_types=1);

$basePath = __DIR__;

function createDir($path) {
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

$modules = [
    [
        'id' => 'Pages',
        'dir' => 'Admin/Pages',
        'list_class' => 'PageList',
        'form_class' => 'PageForm',
        'model' => 'Page',
        'route' => 'admin.pages',
        'fields' => ['title' => 'Title', 'slug' => 'Slug', 'status' => 'Status'],
        'type' => 'pages'
    ],
    [
        'id' => 'HeroSlides',
        'dir' => 'Admin/Homepage',
        'list_class' => 'HeroSlideList',
        'form_class' => 'HeroSlideForm',
        'model' => 'HeroSlide',
        'route' => 'admin.homepage.hero-slides',
        'fields' => ['image' => 'Image', 'title' => 'Title', 'is_active' => 'Active'],
        'type' => 'sortable'
    ],
    [
        'id' => 'Statistics',
        'dir' => 'Admin/Homepage',
        'list_class' => 'StatisticList',
        'form_class' => 'StatisticForm',
        'model' => 'Statistic',
        'route' => 'admin.homepage.statistics',
        'fields' => ['label' => 'Label', 'value' => 'Value'],
        'type' => 'basic'
    ],
    [
        'id' => 'Testimonials',
        'dir' => 'Admin/Homepage',
        'list_class' => 'TestimonialList',
        'form_class' => 'TestimonialForm',
        'model' => 'Testimonial',
        'route' => 'admin.homepage.testimonials',
        'fields' => ['name' => 'Name', 'role' => 'Role', 'content' => 'Content'],
        'type' => 'basic'
    ],
    [
        'id' => 'Partners',
        'dir' => 'Admin/Partners',
        'list_class' => 'PartnerList',
        'form_class' => 'PartnerForm',
        'model' => 'Partner',
        'route' => 'admin.partners',
        'fields' => ['name' => 'Name', 'logo' => 'Logo'],
        'type' => 'basic'
    ],
    [
        'id' => 'CallToActions',
        'dir' => 'Admin/Homepage',
        'list_class' => 'CallToActionList',
        'form_class' => 'CallToActionForm',
        'model' => 'CallToAction',
        'route' => 'admin.homepage.call-to-actions',
        'fields' => ['title' => 'Title', 'url' => 'URL'],
        'type' => 'basic'
    ],
    [
        'id' => 'FeaturedSections',
        'dir' => 'Admin/Homepage',
        'list_class' => 'FeaturedSectionList',
        'form_class' => 'FeaturedSectionForm',
        'model' => 'FeaturedSection',
        'route' => 'admin.homepage.featured-sections',
        'fields' => ['title' => 'Title', 'status' => 'Status'],
        'type' => 'basic'
    ],
    [
        'id' => 'News',
        'dir' => 'Admin/News',
        'list_class' => 'NewsList',
        'form_class' => 'NewsForm',
        'model' => 'News',
        'route' => 'admin.news',
        'fields' => ['title' => 'Title', 'category_id' => 'Category', 'status' => 'Status', 'published_at' => 'Published Date'],
        'type' => 'news'
    ],
    [
        'id' => 'BlogPosts',
        'dir' => 'Admin/Blog',
        'list_class' => 'PostList',
        'form_class' => 'PostForm',
        'model' => 'Post',
        'route' => 'admin.blog',
        'fields' => ['title' => 'Title', 'category_id' => 'Category', 'status' => 'Status'],
        'type' => 'news'
    ],
    [
        'id' => 'Categories',
        'dir' => 'Admin/Categories',
        'list_class' => 'CategoryList',
        'form_class' => 'CategoryForm',
        'model' => 'Category',
        'route' => 'admin.categories',
        'fields' => ['name' => 'Name', 'type' => 'Type'],
        'type' => 'categories'
    ],
    [
        'id' => 'Tags',
        'dir' => 'Admin/Tags',
        'list_class' => 'TagList',
        'form_class' => 'TagForm',
        'model' => 'Tag',
        'route' => 'admin.tags',
        'fields' => ['name' => 'Name'],
        'type' => 'basic'
    ],
    [
        'id' => 'Comments',
        'dir' => 'Admin/Comments',
        'list_class' => 'CommentList',
        'form_class' => '',
        'model' => 'Comment',
        'route' => 'admin.comments',
        'fields' => ['author' => 'Author', 'content' => 'Content', 'status' => 'Status'],
        'type' => 'comments'
    ],
    [
        'id' => 'Gallery',
        'dir' => 'Admin/Gallery',
        'list_class' => 'GalleryList',
        'form_class' => 'GalleryForm',
        'model' => 'Gallery',
        'route' => 'admin.gallery',
        'fields' => ['title' => 'Title', 'image_count' => 'Images'],
        'type' => 'gallery'
    ],
    [
        'id' => 'Downloads',
        'dir' => 'Admin/Downloads',
        'list_class' => 'DownloadList',
        'form_class' => 'DownloadForm',
        'model' => 'Download',
        'route' => 'admin.downloads',
        'fields' => ['title' => 'Title', 'file' => 'File', 'downloads' => 'Downloads'],
        'type' => 'basic'
    ],
    [
        'id' => 'Faqs',
        'dir' => 'Admin/Faq',
        'list_class' => 'FaqList',
        'form_class' => 'FaqForm',
        'model' => 'Faq',
        'route' => 'admin.faq',
        'fields' => ['question' => 'Question', 'category_id' => 'Category'],
        'type' => 'basic'
    ],
    [
        'id' => 'ContactMessages',
        'dir' => 'Admin/Contact',
        'list_class' => 'ContactMessageList',
        'form_class' => '',
        'model' => 'ContactMessage',
        'route' => 'admin.contact',
        'fields' => ['name' => 'Name', 'email' => 'Email', 'subject' => 'Subject', 'is_read' => 'Read'],
        'type' => 'contact'
    ],
    [
        'id' => 'NewsletterSubscribers',
        'dir' => 'Admin/Newsletter',
        'list_class' => 'SubscriberList',
        'form_class' => '',
        'model' => 'Subscriber',
        'route' => 'admin.newsletter',
        'fields' => ['email' => 'Email', 'is_verified' => 'Verified'],
        'type' => 'newsletter'
    ],
    [
        'id' => 'CouncilMembers',
        'dir' => 'Admin/Council',
        'list_class' => 'CouncilMemberList',
        'form_class' => 'CouncilMemberForm',
        'model' => 'CouncilMember',
        'route' => 'admin.council',
        'fields' => ['name' => 'Name', 'position' => 'Position'],
        'type' => 'basic'
    ],
    [
        'id' => 'Menus',
        'dir' => 'Admin/Menus',
        'list_class' => 'MenuManager',
        'form_class' => '',
        'model' => 'Menu',
        'route' => 'admin.menus',
        'fields' => ['name' => 'Name', 'location' => 'Location'],
        'type' => 'menus'
    ]
];

function kebabCase($string) {
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $string));
}

foreach ($modules as $module) {
    $phpDir = $basePath . '/app/Livewire/' . $module['dir'];
    $bladeDir = $basePath . '/resources/views/livewire/' . strtolower(str_replace('Admin/', 'admin/', $module['dir']));
    
    createDir($phpDir);
    createDir($bladeDir);
    
    $namespace = str_replace('/', '\\', 'App\\Livewire\\' . $module['dir']);
    
    // --- LIST PHP ---
    if ($module['list_class']) {
        $listFile = $phpDir . '/' . $module['list_class'] . '.php';
        $listBladeName = 'livewire.' . strtolower(str_replace('Admin/', 'admin/', $module['dir'])) . '.' . kebabCase($module['list_class']);
        
        $phpListContent = "<?php\ndeclare(strict_types=1);\n\nnamespace {$namespace};\n\nuse Livewire\\Component;\nuse Livewire\\WithPagination;\nuse Livewire\\Attributes\\Layout;\nuse Livewire\\Attributes\\Title;\nuse App\\Models\\{$module['model']};\n\n#[Layout('components.layouts.admin')]\n#[Title('Manage {$module['id']}')]\nclass {$module['list_class']} extends Component\n{\n    use WithPagination;\n\n    public string \$search = '';\n    public array \$selected = [];\n\n    public function delete(int \$id): void\n    {\n        \$this->authorize('delete', {$module['model']}::class);\n        \$record = {$module['model']}::findOrFail(\$id);\n        \$record->delete();\n        activity()->performedOn(\$record)->log('deleted');\n        \$this->dispatch('notify', type: 'success', message: 'Record deleted successfully.');\n    }\n\n    public function render()\n    {\n        \$this->authorize('viewAny', {$module['model']}::class);\n        \$records = {$module['model']}::query()\n            ->when(\$this->search, fn(\$q) => \$q->where('title', 'like', '%' . \$this->search . '%')->orWhere('name', 'like', '%' . \$this->search . '%'))\n            ->paginate(15);\n\n        return view('{$listBladeName}', compact('records'));\n    }\n}\n";
        file_put_contents($listFile, $phpListContent);
        
        // LIST BLADE
        $bladeListFile = $bladeDir . '/' . kebabCase($module['list_class']) . '.blade.php';
        $bladeListContent = "<div>\n    <div class=\"flex justify-between items-center mb-6\">\n        <h1 class=\"text-2xl font-semibold text-neural-900 dark:text-neural-100\">Manage {$module['id']}</h1>\n        <x-ui.button wire:navigate href=\"{{ route('{$module['route']}.create') }}\">Create New</x-ui.button>\n    </div>\n    <x-ui.card>\n        <div class=\"p-4 flex items-center justify-between border-b border-neural-200 dark:border-neural-700\">\n            <x-ui.input wire:model.live=\"search\" placeholder=\"Search...\" type=\"search\" class=\"w-64\" />\n        </div>\n        <x-ui.table>\n            <x-slot:head>\n                <x-ui.table.row>\n";
        foreach($module['fields'] as $label) {
            $bladeListContent .= "                    <x-ui.table.heading>{$label}</x-ui.table.heading>\n";
        }
        $bladeListContent .= "                    <x-ui.table.heading class=\"text-right\">Actions</x-ui.table.heading>\n                </x-ui.table.row>\n            </x-slot:head>\n            <x-slot:body>\n                @forelse(\$records as \$record)\n                <x-ui.table.row>\n";
        foreach(array_keys($module['fields']) as $field) {
            $bladeListContent .= "                    <x-ui.table.cell>{{ \$record->{$field} ?? 'N/A' }}</x-ui.table.cell>\n";
        }
        $bladeListContent .= "                    <x-ui.table.cell class=\"text-right\">\n                        <x-ui.button size=\"sm\" variant=\"secondary\" wire:navigate href=\"{{ route('{$module['route']}.edit', \$record) }}\">Edit</x-ui.button>\n                        <x-ui.button size=\"sm\" variant=\"danger\" wire:click=\"delete({{ \$record->id }})\" wire:confirm=\"Are you sure?\">Delete</x-ui.button>\n                    </x-ui.table.cell>\n                </x-ui.table.row>\n                @empty\n                <x-ui.table.row>\n                    <x-ui.table.cell colspan=\"10\" class=\"text-center text-neural-500\">No records found.</x-ui.table.cell>\n                </x-ui.table.row>\n                @endforelse\n            </x-slot:body>\n        </x-ui.table>\n        <div class=\"p-4 border-t border-neural-200 dark:border-neural-700\">\n            {{ \$records->links() }}\n        </div>\n    </x-ui.card>\n</div>\n";
        file_put_contents($bladeListFile, $bladeListContent);
    }

    // --- FORM PHP ---
    if ($module['form_class']) {
        $formFile = $phpDir . '/' . $module['form_class'] . '.php';
        $formBladeName = 'livewire.' . strtolower(str_replace('Admin/', 'admin/', $module['dir'])) . '.' . kebabCase($module['form_class']);
        
        $phpFormContent = "<?php\ndeclare(strict_types=1);\n\nnamespace {$namespace};\n\nuse Livewire\\Component;\nuse Livewire\\Attributes\\Layout;\nuse Livewire\\Attributes\\Title;\nuse Illuminate\\Support\\Str;\nuse Livewire\\WithFileUploads;\nuse App\\Models\\{$module['model']};\n\n#[Layout('components.layouts.admin')]\n#[Title('Form {$module['id']}')]\nclass {$module['form_class']} extends Component\n{\n    use WithFileUploads;\n\n    public ?int \$recordId = null;\n";
        foreach(array_keys($module['fields']) as $field) {
            $phpFormContent .= "    public \${$field};\n";
        }
        $phpFormContent .= "\n    public function mount(\$id = null): void\n    {\n        if (\$id) {\n            \$record = {$module['model']}::findOrFail(\$id);\n            \$this->authorize('update', \$record);\n            \$this->recordId = \$record->id;\n";
        foreach(array_keys($module['fields']) as $field) {
            $phpFormContent .= "            \$this->{$field} = \$record->{$field};\n";
        }
        $phpFormContent .= "        } else {\n            \$this->authorize('create', {$module['model']}::class);\n        }\n    }\n\n    public function save()\n    {\n        \$this->validate([\n";
        foreach(array_keys($module['fields']) as $field) {
            $phpFormContent .= "            '{$field}' => 'nullable',\n"; // Basic validation
        }
        $phpFormContent .= "        ]);\n\n        \$data = [\n";
        foreach(array_keys($module['fields']) as $field) {
            $phpFormContent .= "            '{$field}' => \$this->{$field},\n";
        }
        $phpFormContent .= "        ];\n\n        if (\$this->recordId) {\n            \$record = {$module['model']}::findOrFail(\$this->recordId);\n            \$record->update(\$data);\n            activity()->performedOn(\$record)->log('updated');\n        } else {\n            \$record = {$module['model']}::create(\$data);\n            activity()->performedOn(\$record)->log('created');\n        }\n\n        \$this->dispatch('notify', type: 'success', message: 'Record saved successfully.');\n        return \$this->redirect(route('{$module['route']}.index'), navigate: true);\n    }\n\n    public function render()\n    {\n        return view('{$formBladeName}');\n    }\n}\n";
        file_put_contents($formFile, $phpFormContent);
        
        // FORM BLADE
        $bladeFormFile = $bladeDir . '/' . kebabCase($module['form_class']) . '.blade.php';
        $bladeFormContent = "<div>\n    <div class=\"flex justify-between items-center mb-6\">\n        <h1 class=\"text-2xl font-semibold text-neural-900 dark:text-neural-100\">{{ \$recordId ? 'Edit' : 'Create' }} {$module['model']}</h1>\n        <x-ui.button wire:navigate variant=\"secondary\" href=\"{{ route('{$module['route']}.index') }}\">Back</x-ui.button>\n    </div>\n    <form wire:submit=\"save\">\n        <div class=\"grid grid-cols-1 md:grid-cols-3 gap-6\">\n            <div class=\"md:col-span-2 space-y-6\">\n                <x-ui.card>\n                    <div class=\"p-6 space-y-4\">\n";
        foreach(array_keys($module['fields']) as $field) {
            $bladeFormContent .= "                        <div>\n                            <label class=\"block text-sm font-medium text-neural-700 dark:text-neural-300\">" . ucfirst($field) . "</label>\n                            <x-ui.input wire:model=\"{$field}\" class=\"w-full mt-1\" />\n                            @error('{$field}') <span class=\"text-danger-500 text-sm\">{{ \$message }}</span> @enderror\n                        </div>\n";
        }
        $bladeFormContent .= "                    </div>\n                </x-ui.card>\n            </div>\n            <div class=\"space-y-6\">\n                <x-ui.card>\n                    <div class=\"p-6 space-y-4\">\n                        <x-ui.button type=\"submit\" class=\"w-full\">\n                            <span wire:loading.remove wire:target=\"save\">Save Record</span>\n                            <span wire:loading wire:target=\"save\">Saving...</span>\n                        </x-ui.button>\n                    </div>\n                </x-ui.card>\n            </div>\n        </div>\n    </form>\n</div>\n";
        file_put_contents($bladeFormFile, $bladeFormContent);
    }
}

echo "All modules generated successfully!\n";
