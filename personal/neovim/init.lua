-- 
-- Platform Agnostic Keymaps
-- 
vim.g.mapleader = ","

local keymap = vim.keymap

-- Do not yank with X
keymap.set('n', 'x', '"_x')

-- Increment/Decrement
keymap.set('n', '+', '<C-a>')
keymap.set('n', '-', '<C-x>')

-- Select all
keymap.set('n', '<C-a>', 'gg<S-v>G')

if vim.g.vscode then
    -- VSCode Shortcuts

    -- Split editor
    keymap.set('n', 'ss', "<cmd>:call VSCodeNotify('workbench.action.splitEditor')<CR>")
    keymap.set('n', 'sv', "<cmd>:call VSCodeNotify('workbench.action.splitEditorDown')<CR>")

    -- Move editor
    keymap.set('', 'sn', "<cmd>:call VSCodeNotify('workbench.action.navigateLeft')<CR>")
    keymap.set('', 'se', "<cmd>:call VSCodeNotify('workbench.action.navigateDown')<CR>")
    keymap.set('', 'si', "<cmd>:call VSCodeNotify('workbench.action.navigateUp')<CR>")
    keymap.set('', 'so', "<cmd>:call VSCodeNotify('workbench.action.navigateRight')<CR>")

    -- Toggle Zen Mode
    keymap.set('', 'zm', "<cmd>:call VSCodeNotify('workbench.action.toggleZenMode')<CR>")

    -- Write all
    keymap.set('', '<Leader>w', ":call VSCodeNotify('workbench.action.files.saveAll')<CR>")
    -- Write active
    keymap.set('', '<Leader><Leader>w', ":call VSCodeNotify('workbench.action.files.save')<CR>")
    -- Close all
    keymap.set('', '<Leader>q', ":call VSCodeNotify('workbench.action.closeAllEditors')<CR>")
    -- Close active
    keymap.set('', '<Leader><Leader>q', ":call VSCodeNotify('workbench.action.closeActiveEditor')<CR>")
    -- Close all others
    keymap.set('', '<Leader><Leader><Leader>q', ":call VSCodeNotify('workbench.action.closeOtherEditors')<CR>")

    -- Toggle Sidebar
    keymap.set('', 'tb', ":call VSCodeNotify('workbench.action.toggleSidebarVisibility')<CR>")
else
    -- Vanilla Neovim

    -- 
    -- Base config
    -- 

    vim.cmd('autocmd!')

    vim.scriptencoding = 'utf-8'
    vim.opt.encoding = 'utf-8'
    vim.opt.fileencoding = 'utf-8'

    vim.wo.number = true

    vim.opt.title = true
    vim.opt.autoindent = true
    vim.opt.smartindent = true
    vim.opt.hlsearch = true
    vim.opt.backup = true
    vim.opt.showcmd = true
    vim.opt.cmdheight = 1
    vim.opt.laststatus = 2
    vim.opt.expandtab = true
    vim.opt.scrolloff = 10
    vim.opt.shell = 'xterm'
    vim.opt.inccommand = 'split'
    vim.opt.smarttab = true
    vim.opt.breakindent = true
    vim.opt.shiftwidth = 2
    vim.opt.tabstop = 2
    vim.opt.wrap = false -- No wrap lines
    vim.opt.backspace = {'start', 'eol', 'indent'}
    vim.opt.path:append{'**'} -- Finding files - Search down into subfolders
    vim.opt.wildignore:append{'*/node_modules/*'}

    -- Undercurl
    vim.cmd([[let &t_Cs = "\e[4:3m"]])
    vim.cmd([[let &t_Ce = "\e[4:0m"]])

    -- Turn off paste mode when leaving insert 
    vim.api.nvim_create_autocmd("InsertLeave", {
        pattern = '*',
        command = "set nopaste"
    })

    -- Add asterisks in block comments
    vim.opt.formatoptions:append{'r'}

    -- 
    -- Highlights
    -- 

    vim.opt.cursorline = true
    vim.opt.termguicolors = true
    vim.opt.winblend = 0
    vim.opt.wildoptions = 'pum'
    vim.opt.pumblend = 5
    vim.opt.background = 'dark'
end

-- 
-- Load Plugins
-- 

local status, packer = pcall(require, "packer")
if (not status) then
    print("Packer is not installed")
    return
end

vim.cmd [[packadd packer.nvim]]

packer.startup(function(use)
    use 'wbthomason/packer.nvim'
    use {
        'catppuccin/nvim',
        as = 'catppuccin'
    }
    use {
        'phaazon/hop.nvim',
        branch = 'v2' -- optional but strongly recommended
    }
end)

-- 
-- Catppuccin config
-- 

vim.g.catppuccin_flavour = "mocha" -- latte, frappe, macchiato, mocha

require("catppuccin").setup({
    integrations = {
        hop = true
    }
})

vim.cmd.colorscheme "catppuccin"

-- 
-- Hop config
-- 

local status, hop = pcall(require, "hop")
if (not status) then
    return
end

hop.setup {
    keys = 'etovxqpdygfblzhckisuran'
}
-- Hop line
vim.api.nvim_set_keymap('', 'hll', "<cmd>lua require'hop'.hint_lines()<cr>", {})
-- Hop line before cursor
vim.api.nvim_set_keymap('', 'hlb',
    "<cmd>lua require'hop'.hint_lines({ direction = require'hop.hint'.HintDirection.BEFORE_CURSOR })<cr>", {})
-- Hop line after cursor
vim.api.nvim_set_keymap('', 'hla',
    "<cmd>lua require'hop'.hint_lines({ direction = require'hop.hint'.HintDirection.AFTER_CURSOR })<cr>", {})
-- Hop word
vim.api.nvim_set_keymap('', 'hww', "<cmd>lua require'hop'.hint_words()<cr>", {})
-- Hop word before cursor
vim.api.nvim_set_keymap('', 'hwb',
    "<cmd>lua require'hop'.hint_words({ direction = require'hop.hint'.HintDirection.BEFORE_CURSOR })<cr>", {})
-- Hop word after cursor
vim.api.nvim_set_keymap('', 'hwa',
    "<cmd>lua require'hop'.hint_words({ direction = require'hop.hint'.HintDirection.AFTER_CURSOR })<cr>", {})
-- Hop char 1
vim.api.nvim_set_keymap('', 'h1', "<cmd>lua require'hop'.hint_char1()<cr>", {})
-- Hop char 2
vim.api.nvim_set_keymap('', 'h2', "<cmd>lua require'hop'.hint_char2()<cr>", {})
-- Hop pattern
vim.api.nvim_set_keymap('', 'hp', "<cmd>lua require'hop'.hint_patterns()<cr>", {})
-- Hop vertical
vim.api.nvim_set_keymap('', 'hv', "<cmd>lua require'hop'.hint_vertical()<cr>", {})
